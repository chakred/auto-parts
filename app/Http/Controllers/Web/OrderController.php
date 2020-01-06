<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    /**
     * Store a new order
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreOrderRequest $request)
    {

        Order::create([
            'goods_id' => $request->input('good_id'),
            'quantity' => $request->input('quantity'),
            'bought_price' => $request->input('bought_price'),
            'buyer_name' => $request->input('buyer_name'),
            'buyer_phone' => $request->input('buyer_phone'),
            'rate' => $request->input('fixed_rate'),
            'currency_name' => $request->input('currency_name')
        ]);
        return back();

    }
}
