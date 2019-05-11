<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Auto_model;
use App\Auto_mark;
use App\Good;
use App\Category;
use App\ApiBank\BankUkrainian;
use App\ViewCounter;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, BankUkrainian $apiBank, ViewCounter $viewCounter)
    {
        $viewNumbers = $viewCounter->createCookie();
        $subCategoryId = $request->route('subCategory');
        $modelId = $request->route('model');

        $model = Auto_model::where('id','=', $modelId)->first();
        $marks = Auto_mark::all();
        $relatedGoods = Good::where('id_model','=', $modelId)->where('id_sub_category','=', $subCategoryId)->get();

        foreach ($relatedGoods as $good) {
            if (isset($good->profit) && $good->profit != null) {
                $percentOfProfit = $good->cost/100*$good->profit;
                $good->convertedPrice = $good->cost+$percentOfProfit;
            } else {
                $good->convertedPrice = $good->cost;
            }
            if (isset($good->discount) && $good->discount != null) {
                $percentOfDiscount = $good->convertedPrice/100*$good->profit;
                $good->convertedPrice = $good->convertedPrice-$percentOfDiscount;
            }

            switch($good->currency) {
                case 'EUR':
                    $apiCurrency = $apiBank->chooseOneCurrency($good->currency);
                    $good->convertedPrice = round($good->convertedPrice*$apiCurrency['rate']);
                    break;
                case 'USD':
                    $apiCurrency = $apiBank->chooseOneCurrency($good->currency);
                    $good->convertedPrice = round($good->convertedPrice*$apiCurrency['rate']);
                    break;
            }
        }

        return view ('pages.goods-page', compact('model','marks', 'relatedGoods', 'viewNumbers'));
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
        //
    }
}
