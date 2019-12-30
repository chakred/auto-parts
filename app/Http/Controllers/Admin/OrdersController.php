<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('goods')
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

        $orders = $orders->each(function($item) {
           $item->convertedPrice = $item->bought_price;
           $item->totalSum = $item->quantity * $item->bought_price;
        });

        return view('admin.orders.index', compact( 'orders'));
    }

    /**
     * This function return only new orders
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexNew()
    {
        $orders = Order::new()
            ->orderBy('created_at', 'DESC')
            ->paginate(15);
        return view('admin.orders.new', compact( 'orders'));
    }

    /**
     * Change status of a new order to handled
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle($id)
    {
        Order::find($id)->update([
            'status' => 'handled'
        ]);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $order->totalSum = $order->convertedPrice * $order->quantity;
        return view('admin.orders.edit', compact( 'order'));
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
        dd($id);
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
