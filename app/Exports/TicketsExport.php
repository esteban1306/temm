<?php

namespace App\Exports;

use App\Ticket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;
use App\Models\Partner;
use Carbon\Carbon;
use DateTime;

class TicketsExport implements FromCollection
{

    protected $range;

    public function __construct($range = null)
    {
        $this->range = $range;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $collection = collect([["Fecha", "Hora Entrada", "Hora Salida", "Placa", "Tipo Vehiculo", "Valor cancelado", "Usuario", "Estado"]]);

		$tickets= Ticket::select(['created_at', 'hour', 'pay_day', 'plate', 'type', 'price', 'partner_id', 'status'])->where('parking_id',Auth::user()->parking_id)->orderBy('ticket_id','desc');
		$dateRange = explode(" - ", $this->range);
        $tickets = $tickets->whereBetween('created_at', [$dateRange[0].' 00:00:00', $dateRange[1].' 23:59:59'])->get();

        $cantidad = 0;
        $precio = 0;
        foreach ($tickets as $ticket){
            $ticket->price = format_money($ticket->price);
            $partner = Partner::find($ticket->partner_id);
            $ticket->partner_id =  $partner ?$partner->name:'';
            $ticket->status = $ticket->status == 1? 'Pendiente Pago': 'Pagó';
            $hour =new DateTime("".$ticket->hour);
            $ticket->hour = $hour->format('h:ia');
            $hour =new DateTime("".$ticket->created_at);
            $ticket->created_at = $hour->format('d/m/Y');
            $hour =new DateTime("".$ticket->pay_day);
            $ticket->pay_day = $hour->format('h:ia');
            $ticket->type = $ticket->type == 1? 'Carro': ($ticket->type == 3 ? ( isBici()?'Bicicleta':'Camioneta' ) : 'Moto');
            $collection->push($ticket);
            //$cantidad += $product->cantidad;
            //$precio += $product->valor;
        }
        /*$collection->push(collect([["TOTALES", $cantidad, "", $precio]]));*/
        return $collection;
    }
}
