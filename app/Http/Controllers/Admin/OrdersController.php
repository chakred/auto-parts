<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Good;
use App\ApiBank\BankUkrainian;
use App\Order;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BankUkrainian $apiBank)
    {
        $orders = Order::orderBy('id', 'DESC')->paginate(15);

        foreach ($orders as $value) {

            if ($value->goods->currency == 'USD') {
                $apiCurrency = $apiBank->chooseOneCurrency('USD');
                $value->convertedPrice = rtrim(round($value->goods->cost*$apiCurrency['rate'],0),0);
            } elseif ($value->goods->currency == 'EUR') {
                $apiCurrency = $apiBank->chooseOneCurrency('EUR');
                $value->convertedPrice = rtrim(round($value->goods->cost*$apiCurrency['rate'],0),0);
            } else {
                $value->convertedPrice = $value->cost;
            }
            $value->totalSum = $value->convertedPrice*$value->quantity;
        }

        return view('admin.orders.index', compact( 'orders'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $good = Order::find($id);
        $good->delete();
        return back();
    }
}
