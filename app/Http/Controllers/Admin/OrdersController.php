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

        foreach ($orders as $order) {
            $order->convertedPrice = $order->bought_price;
            $order->totalSum = $order->quantity * $order->bought_price;
        }
        $notFound = false;

        return view('admin.orders.index', compact( 'orders', 'notFound'));
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

        foreach ($orders as $order) {
            $order->convertedPrice = $order->bought_price;
            $order->totalSum = $order->quantity * $order->bought_price;
        }
        $notFound = false;

        return view('admin.orders.new', compact( 'orders', 'notFound'));
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
        return back();
    }

    /**
     * Search in all orders according to key word
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchInAll(Request $request)
    {
        $orders = new Order;
        if ($request->has('searchKey')) {
            $orders = $orders->keyWord($request->searchKey);
        }
        $orders = $orders->paginate(15);
        $notFound = $orders->count() == 0 ? true : false;
        return view('admin.orders.index', compact( 'orders', 'notFound'));
    }

    /**
     * Search in new orders according to key word
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchInNew(Request $request)
    {
        $orders = new Order;
        if ($request->has('searchKey')) {
            $orders = $orders->new()->keyWord($request->searchKey);
        }
        $orders = $orders->paginate(15);
        $notFound = $orders->count() == 0 ? true : false;
        return view('admin.orders.new', compact( 'orders', 'notFound'));
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
