<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;

class ProductsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $collection = collect([["Nombre Producto", "Cantidad"]]);
        $products = Product::select(['name', 'cantidad'])->where('parking_id',Auth::user()->parking_id)->get();
        return $collection->push($products);
    }
}
