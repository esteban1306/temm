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
        $transaction = new Transaction();
        $transaction->precio = $request->precio;
        $transaction->tipo = $request->tipo;
        $transaction->description = strtoupper($request->description);
        $transaction->parking_id = Auth::user()->parking_id;
        $transaction->partner_id = Auth::user()->partner_id;
        $transaction->save();

        return ;
    }

    public function updateTransaction(Request $request)
    {
        $ticket = Transaction::find($request->transaction);
        $ticket->description =strtoupper($request->description??'');
        $ticket->tipo =$request->tipo;
        $ticket->precio =$request->precio;
        $ticket->save();
        return ;
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
        $tipo = $request->get('tipo')?? null;

        $tickets= Transaction::select(['id_transaction as Id', 'precio', 'partner_id','created_at','customer_id','tipo','description'])->where('parking_id',Auth::user()->parking_id)->orderBy('id_transaction','desc');
        if (!empty($range)) {
            $dateRange = explode(" - ", $range);
            $tickets = $tickets->whereBetween('created_at', [$dateRange[0], $dateRange[1]]);
        }
        if (!empty($customer))
            $tickets = $tickets->where('customer_id', $customer);
        if (!empty($tipo))
            $tickets = $tickets->where('tipo', $tipo);

        return Datatables::of($tickets)
            ->addColumn('action', function ($tickets) {
                    return \Form::button('Eliminar', [
                        'class'   => 'btn btn-warning',
                        'onclick' => "eliminarTransaction('$tickets->Id')",
                        'data-toggle' => "tooltip",
                        'data-placement' => "bottom",
                        'title' => "Eliminar !",

                    ]).($tickets->tipo == 1?
                            \Form::button('Editar', [
                                'class'   => 'btn btn-primary',
                                'onclick' => "openModalVenta('$tickets->Id','".format_money($tickets->precio)."','".($tickets->customer_id ?? '')."')",
                                'data-toggle' => "tooltip",
                                'data-placement' => "bottom",
                                'title' => "Editar !",

                            ]) :'')
                        .(!empty($tickets->customer_id)?
                        \Form::button('Editar Cliente', [
                            'class'   => 'btn btn-primary',
                            'onclick' => "openModalClienteMod($tickets->customer_id)",
                            'data-toggle' => "tooltip",
                            'data-placement' => "bottom",
                            'title' => "Editar Cliente",

                        ]) :'')
                        .($tickets->tipo != 1?
                        \Form::button('Editar Gasto', [
                            'class'   => 'btn btn-primary',
                            'onclick' => "openModalGastoMod($tickets->Id)",
                            'data-toggle' => "tooltip",
                            'data-placement' => "bottom",
                            'title' => "Editar Gasto",

                        ]) :'').($tickets->tipo == 1?
                            \Form::button('Imprimir', [
                                'class'   => 'btn btn-info',
                                'onclick' => "form_pdf('$tickets->Id')",
                                'data-toggle' => "tooltip",
                                'data-placement' => "bottom",
                                'title' => "Imprimir !",

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
                return  $hour->format('d/m/Y  h:ia').' '.$tickets->description ;
            })
            ->make(true);
    }


    public function getStatus(Request $request)
    {
        $schedule = $request->get('type');
        $type = $request->get('type_car');
        $range = $request->get('range');
        $status = $request->get('status');

        $tickets= Transaction::select(['id_transaction as Id', 'precio', 'partner_id','created_at','tipo'])->where('parking_id',Auth::user()->parking_id)->orderBy('id_transaction','desc');
        if (!empty($range)) {
            $dateRange = explode(" - ", $range);
            $tickets = $tickets->whereBetween('created_at', [$dateRange[0], $dateRange[1]]);
        }
        $status = [];
        $status['total'] = ZERO;
        $status['surtido'] = ZERO;
        $status['gastos'] = ZERO;
        $status['recaudado'] = ZERO;
        $status['month_expire'] = 'Mensualidades por vencer:';
        $status['month_expire_num'] = ZERO;

        $tickets=$tickets->get();
        $now = new Datetime('now');
        foreach ($tickets as $ticket){
            if($ticket->tipo == 1){
                $status['total'] += $ticket->precio;
                $status['recaudado'] += $ticket->precio;
            }
            if($ticket->tipo == 2){
                $status['surtido'] += $ticket->precio;
                $status['total'] -= $ticket->precio;
            }
            if($ticket->tipo == 3){
                $status['gastos'] += $ticket->precio;
                $status['total'] -= $ticket->precio;
            }
        }
        $status['total'] = format_money($status['total']);
        $status['surtido'] = format_money($status['surtido']);
        $status['gastos'] = format_money($status['gastos']);
        $status['recaudado'] = format_money($status['recaudado']);
        return $status;
    }
    public function getTransaction(Request $request)
    {
        $ticket = Transaction::find($request->id);
        return $ticket;
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
    public function pdf(Request $request)
    {
        $id = $request->id_pdf;
        $ticket= Transaction::find($id);
        $hour =new DateTime("".$ticket->created_at);
        $incomes = Income::select(['id_income as Id', 'precio', 'product_id', 'cantidad','description'])->where('parking_id',Auth::user()->parking_id)->where('transaction_id', $id)->orderBy('id_income','desc')->get();
        $incomes_text = "";
        foreach ($incomes as $income){
            $incomes_text.="<tr>
    <td>".$income->product_id."</td>
    <td>".$income->cantidad."</td> 
    <td>".format_money($income->precio)."</td>
  </tr>";
        }

        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => false,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );
        PDF::SetTitle('Venta');
        PDF::AddPage('P', 'A6');
        $marginRight = Auth::user()->parking_id == 5?57:45;
        $marginLeft = Auth::user()->parking_id == 5?2:6;
        $size = Auth::user()->parking_id == 5?'8px':'small';
        PDF::SetMargins($marginLeft, 0, $marginRight);
        $parking = Parking::find(Auth::user()->parking_id);
        $html = '<div style="text-align:center; margin-top: -10px !important"><big style="margin-bottom: 1px"><b style="letter-spacing: -1 px;">&nbsp;'.$parking->name.'</b></big><br>
                '.($parking->parking_id !=5?'<em style="font-size: 7px;margin-top: 2px;margin-bottom: 1px">"Todo lo puedo en Cristo que<br> me fortalece": Fil 4:13 <br></em>':'').'
                <small style="font-size: x-small;margin-top: 1px;margin-bottom: 1px"><b>'.$parking->address.'</b></small>'
            .($parking->parking_id!=1?'<small style="text-align:center;font-size: 6px"><br>
    NIT:41917760-5  <br>GLORIA LILIANA GRISALES<br> </small><small style="text-align:center;font-size: 8px"><b>SERVICIO: lun-vie 7am-pm, sab 7am-1pm</b><br> <b> TEL: 3146246181</b></small>':'');

        $html .= '<small style="text-align:left;font-size: '.$size.';margin-bottom: 1px;"><b><br>
            FACTURA DE VENTA N°  '. $id . '<br> 
             Fecha ingreso: ' . $hour->format('d/m/Y') . '<br>
             Hora ingreso: ' . $hour->format('h:ia') . '<br>
             Precio: ' . format_money($ticket->precio) . '<br>
             
            
             </div>
             <table style="width:100%">
  <tr>
    <th>Producto</th>
    <th>Cantidad</th> 
    <th>Precio Total</th>
  </tr>
  '.$incomes_text.'
</table>
             ';

        $html .= '<small style="text-align:left;font-size: 6px"><br>
                 <b>IMPRESO POR TEMM SOFT 3207329971</b>
                 </small>';
        PDF::writeHTML($html, true, false, true, false, '');
        /*if(!isset($ticket->price)){
            $id_bar = substr('0000000000'.$ticket->ticket_id,-10);
            PDF::write1DBarcode($id_bar, 'C128C', '', '', '', 18, 0.4, $style, 'N');
        }*/
        $js = 'print(true);';
        PDF::IncludeJS($js);
        PDF::Output('ticket.pdf');

// set javascript
    }
}
