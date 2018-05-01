<?php

namespace App\Http\Controllers;

use App\Parking;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Auth;

class ParkingController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = Auth::user();
        $parking = Parking::find($user->parking_id);
        $parking->hour_cars_price= $request->hour_cars_price;
        $parking->day_cars_price = $request->day_cars_price  ;
        $parking->monthly_cars_price = $request->monthly_cars_price  ;
        $parking->hour_motorcycles_price = $request->hour_motorcycles_price  ;
        $parking->day_motorcycles_price  = $request->day_motorcycles_price   ;
        $parking->monthly_motorcycles_price  = $request->monthly_motorcycles_price   ;
        $parking->free_time= $request->free_time;
        $parking->cars_num= $request->cars_num;
        $parking->motorcycles_num = $request->motorcycles_num;
        $parking->save();
        return ONE;
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
}
