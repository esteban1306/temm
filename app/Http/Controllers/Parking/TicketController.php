<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Parking;
use App\Ticket;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Html\HtmlServiceProvider;


use PDF; // at the top of the file


class TicketController extends Controller
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
        $now = new DateTime(new Datetime('now',new DateTimeZone('America/New_York')));
        $ticket= new Ticket();
        $ticket->hour =$now;
        $ticket->plate =$request->plate;
        $ticket->status = 1;
        $ticket->type =$request->type;
        $ticket->schedule =$request->schedule;
        $ticket->parking_id = Auth::user()->parking_id;
        $ticket->partner_id = Auth::user()->partner_id;
        $ticket->drawer =$request->drawer;
        $ticket->save();
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
        PDF::SetTitle('Ticket');
        PDF::AddPage();
        $parking = Parking::find(Auth::user()->parking_id);
        PDF::Cell(0, 0, "Parqueadero", 0, 1);
        PDF::Cell(0, 0, $parking->name, 0, 1);
        PDF::Cell(0, 0, $parking->address, 0, 1);
        setlocale(LC_ALL, 'es_ES');
        $fecha = strftime("%b %d, %H:%M");
        PDF::Cell(0, 0, $fecha, 0, 1);
        PDF::Write(2, "Placa: ".$request->plate);
        if(isset($ticket->drawer)){
            PDF::Ln();
            PDF::Write(2, "Locker: ".$ticket->drawer);
        }
        // CODE 128 C
        PDF::Ln();
        $id_bar = substr('0000000000'.$ticket->ticket_id,-10);
        PDF::write1DBarcode($id_bar, 'C128C', '', '', '', 18, 0.4, $style, 'N');
        PDF::Output('ticket.pdf');

        return redirect('/');
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

    public function precio($tiempo, $tipo)
    {
        $horas = $tiempo->format("%H");
        $minutos = $tiempo->format("%I");
        $parking = Parking::find(Auth::user()->parking_id);
        $minutos = ($minutos*1) - ($parking->free_time);
        $horas = (24*$tiempo->format("%d"))+$horas*1 + (($minutos>=0? 1: 0)*1);
        return ($tipo==1? $parking->hour_cars_price * $horas: $parking->hour_motorcycles_price * $horas );
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
        $now = new DateTime(new Datetime('now',new DateTimeZone('America/New_York')));
        $ticket = Ticket::find($request->ticket_id);
        $interval = date_diff(new DateTime("".$ticket->hour),$now);
        $ticket->status = 2;
        $ticket->price =$this->precio($interval,$ticket->type);
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
    public function getTickets(Request $request)
    {
        $search = $request->get('search')['value'];

        $tickets= Ticket::select(['ticket_id as Id', 'plate', 'type', 'schedule', 'partner_id', 'status', 'drawer', 'price'])->where('parking_id',Auth::user()->parking_id)->orderBy('ticket_id');
        if ($search) {
                $tickets = $tickets->where('plate', 'LIKE', "%$search%");
        }
        return Datatables::of($tickets)
            ->addColumn('action', function ($tickets) {
                if ($tickets->status == 1)
                return \Form::button('Pagar', [
                        'class'   => 'btn btn-info',
                        'onclick' => "$('#modal_ticket_out').modal('show');$('#ticket_id').val('$tickets->Id')",
                        'data-toggle' => "tooltip",
                        'data-placement' => "bottom",
                        'title' => "Pagar !",

                    ]) ;
                else
                    return '';
            })
            ->addColumn('Tipo', function ($tickets) {
                return  $tickets->type == 1? 'Carro': 'Moto';
            })
            ->addColumn('Estado', function ($tickets) {
                return  $tickets->status == 1? 'Pendiente Pago': 'Pagó';
            })
            ->addColumn('Atendio', function ($tickets) {
                $partner = Partner::find($tickets->partner_id);
                return  $partner->name;
            })
            ->make(true);
    }
}
