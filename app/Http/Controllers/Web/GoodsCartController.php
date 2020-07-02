<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;


class GoodsCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        // you can specify the id, name, quantity, price of the product you'd like to add to the cart.
        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->quantity,
            'price' => $request->price,
            'options' => [
                'imgPath' => $request->image,
                'tradeMark' => $request->tradeMark
            ]
        ]);
        return back();
    }

    public function removeFromCart(Request $request)
    {
        Cart::remove($request->rowId);
    }

}
