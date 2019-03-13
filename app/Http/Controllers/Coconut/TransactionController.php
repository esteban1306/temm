<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Parking;
use App\Product;
use App\Income;
use App\Transaction;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Html\HtmlServiceProvider;
use Nexmo\Laravel\Facade\Nexmo;
use App\Notifications\Message;

use PDF; // at the top of the file


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return 2;
        $id_transaction =$request->transaction;
        if(empty($request->transaction)){
            $transaction = new Transaction();
            $transaction->precio = 0;
            $transaction->save();
            $id_transaction = $transaction->id_transaction;
        }
        $product = Product::find($request->product);
        $income = new Income();
        $income->cantidad =$request->cantidad?? -1;
        $income->product_id =$request->product;
        $income->transaction_id =$id_transaction;
        $income->parking_id = Auth::user()->parking_id;
        $income->precio = $product->precio*1*$income->cantidad;

        $income->save();

        if($product->cantidad != '-1'){
            $product->cantidad = $product->cantidad - $income->cantidad;
            $product->save();
        }
        $transaction = Transaction::find($id_transaction);
        $transaction->precio = $transaction->precio +$income->precio;
        $transaction->save();
        $return['transaction_id'] = $id_transaction;
        $return['precio'] = format_money($transaction->precio);

        return $return;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function precio($tiempo, $tipo, $schedule)
    {
        $horas = $tiempo->format("%H");
        $horas2 = $tiempo->format("%H");
        $minutos = $tiempo->format("%I");
        $minutos2 = $minutos;
        $parking = Parking::find(Auth::user()->parking_id);
        $minutos = ($minutos*1) - ($parking->free_time);
        $horas = (24*$tiempo->format("%d"))+$horas*1 + (($minutos>=0? 1: 0)*1);
        if($parking->parking_id==4){
            $minutos2 = (((24*$tiempo->format("%d"))+$horas2*1)*60)+($minutos2*1)-60;
            $priceMin = $minutos2 > 0?($tipo==1? $parking->min_cars_price*$minutos2: $parking->min_motorcycles_price*$minutos2):0;
            if($schedule==1)
                return ($tipo==1? $parking->hour_cars_price: $parking->hour_motorcycles_price )+$priceMin;
        }
        if($tiempo->format("%I")<=5 && $horas==0 && ($schedule==1 || $schedule==2))
            return 0;
        $horas = $horas==0? 1: $horas;
        if($schedule==1)
            return ($tipo==1? $parking->hour_cars_price * $horas: ($tipo==2? $parking->hour_motorcycles_price * $horas: $parking->hour_van_price * $horas ));
        if($schedule==2)
            return ($tipo==1? $parking->day_cars_price: ($tipo==2? $parking->day_motorcycles_price: $parking->day_van_price ));
        if($schedule==3)
            return ($tipo==1? $parking->monthly_cars_price: ($tipo==2? $parking->monthly_motorcycles_price: $parking->monthly_van_price ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $now = new Datetime('now');
        $ticket = Ticket::find($request->ticket_id);
        if($ticket->status == 2 && !empty($ticket->pay_day)){
            $interval = date_diff(new DateTime("".$ticket->hour),new DateTime("".$ticket->pay_day));
            return [$ticket->price,$interval->format("%H:%I")];
        }
        $interval = date_diff(new DateTime("".$ticket->hour),$now);
        $ticket->status = 2;
        $now2 = date("Y-m-d H:i:s");
        $ticketss= Ticket::select(['plate'])->where('parking_id',Auth::user()->parking_id)->where('status','<>',"3")->where('plate',$ticket->plate)->where('date_end','>=',$now2)->orderBy('ticket_id','desc')->get();

        if($ticket->schedule != 3 || empty($ticket->price))
            $ticket->price = $this->precio($interval,$ticket->type, $ticket->schedule);
        if($ticketss->count() > 0)
            $ticket->price =0;
        $ticket->pay_day =$now;
        $ticket->save();
        return [$ticket->price,$interval->format("%H:%I")];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getTransactions(Request $request)
    {
        $search = $request->get('search')['value'];
        $transaction = $request->get('transaction');
        $range = $request->get('range');
        $customer = $request->get('customer');

        $tickets= Transaction::select(['id_transaction as Id', 'precio', 'partner_id','created_at','customer_id'])->where('parking_id',Auth::user()->parking_id)->orderBy('id_transaction','desc');
        if (!empty($range)) {
            $dateRange = explode(" - ", $range);
            $tickets = $tickets->whereBetween('created_at', [$dateRange[0], $dateRange[1]]);
        }
        if (!empty($customer))
            $tickets = $tickets->where('customer_id', $customer);

        return Datatables::of($tickets)
            ->addColumn('action', function ($tickets) {
                    return \Form::button('Eliminar', [
                        'class'   => 'btn btn-warning',
                        'onclick' => "eliminarTransaction('$tickets->Id')",
                        'data-toggle' => "tooltip",
                        'data-placement' => "bottom",
                        'title' => "Eliminar !",

                    ]).\Form::button('Editar', [
                            'class'   => 'btn btn-primary',
                            'onclick' => "openModalVenta('$tickets->Id','".format_money($tickets->precio)."')",
                            'data-toggle' => "tooltip",
                            'data-placement' => "bottom",
                            'title' => "Editar !",

                        ])
                        .(!empty($tickets->customer_id)?
                        \Form::button('Editar Cliente', [
                            'class'   => 'btn btn-primary',
                            'onclick' => "openModalClienteMod($tickets->customer_id)",
                            'data-toggle' => "tooltip",
                            'data-placement' => "bottom",
                            'title' => "Editar Cliente",

                        ]) :'');
            })
            ->editColumn('precio', function ($tickets) {
                return format_money($tickets->precio);
            })
            ->editColumn('partner_id', function ($tickets) {
                $partner = Partner::find($tickets->partner_id);
                return  $partner->name;
            })
            ->editColumn('created_at', function ($tickets) {
                $hour =new DateTime("".$tickets->created_at);
                return  $hour->format('d/m/Y  h:ia') ;
            })
            ->make(true);
    }


    public function getStatus(Request $request)
    {
        $schedule = $request->get('type');
        $type = $request->get('type_car');
        $range = $request->get('range');
        $status = $request->get('status');

        $tickets= Transaction::select(['id_transaction as Id', 'precio', 'partner_id','created_at'])->where('parking_id',Auth::user()->parking_id)->orderBy('id_transaction','desc');
        if (!empty($range)) {
            $dateRange = explode(" - ", $range);
            $tickets = $tickets->whereBetween('created_at', [$dateRange[0], $dateRange[1]]);
        }
        $status = [];
        $status['total'] = ZERO;
        $status['extra'] = ZERO;
        $status['carros'] = ZERO;
        $status['motos'] = ZERO;
        $status['month_expire'] = 'Mensualidades por vencer:';
        $status['month_expire_num'] = ZERO;

        $tickets=$tickets->get();
        $now = new Datetime('now');
        foreach ($tickets as $ticket){
            $status['total'] += $ticket->precio;
        }
        $status['total'] = format_money($status['total']);
        return $status;
    }
    public function getProduct(Request $request)
    {
        $ticket = Product::find($request->product_id);
        return $ticket;
    }
    public function updateProduct(Request $request)
    {
        $ticket = Product::find($request->idProduct);
        $ticket->name =strtoupper($request->name);
        $ticket->description =strtoupper($request->description??'');
        $ticket->minimo =$request->minimo??0;
        $ticket->cantidad =$request->cantidad?? -1;
        $ticket->precio =$request->precio;
        $ticket->save();
        return ;
    }
    public function deleteTransaction(Request $request)
    {
        $ticket = Transaction::find($request->transaction);
        $ticket->delete();
        return ;
    }
    public function recoveryTicket(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        $ticket->status = 1;
        $ticket->price =null;
        $ticket->pay_day =null;
        $ticket->save();
        return ;
    }
    public function export(Request $request)
    {
        $id = $request->get('id_transaction');

        $income= Transaction::incomes($id)->get();
        $date_bill = new DateTime($income[0]->fecha_pago);
        $date_bill = $date_bill->format('M. - Y');
        $date = Carbon::now()->toDateString();
        $data     = [
            'date'                 => $date,
            'date_bill'                 => $date_bill,
            'income'               => $income,
            'transaction'          => Transaction::find($id),
            'partner'              => Auth::user()->first_name.' '. Auth::user()->last_name,
            'type_partner'         => Auth::user()->type,
        ];
        return \PDF2::loadView('PDF.transaction', $data)->stream("reporte_$date.pdf");
    }
}
