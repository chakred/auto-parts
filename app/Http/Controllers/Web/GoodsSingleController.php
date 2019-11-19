<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Good;
use App\ViewCounter;
use App\Calculation\PriceCalculation;

class GoodsSingleController extends Controller
{
    /**
     * Display single good
     *
     * @param Request $request
     * @param PriceCalculation $priceCalculation
     * @param ViewCounter $viewCounter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, PriceCalculation $priceCalculation, ViewCounter $viewCounter)
    {
        $viewNumbers = $viewCounter->createCookie();
        $goodsId = $request->route('id');
        $relatedGoods = Good::find($goodsId);
        $relatedGoods = $priceCalculation->calculateSingle($relatedGoods);
        return view ('pages.goods-single-page', compact('relatedGoods','viewNumbers'));
    }
}
