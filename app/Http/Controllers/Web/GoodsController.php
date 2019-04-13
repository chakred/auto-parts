<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Auto_model;
use App\Auto_mark;
use App\Good;
use App\Category;
use App\ApiBank\BankUkrainian;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, BankUkrainian $apiBank)
    {
        $subCategoryId = $request->route('subCategory');
        $modelId = $request->route('model');

        $model = Auto_model::where('id','=', $modelId)->first();
        $marks = Auto_mark::all();
        $relatedGoods = Good::where('id_model','=', $modelId)->where('id_sub_category','=', $subCategoryId)->get();

        foreach ($relatedGoods as $value) {
            if ($value->currency == 'USD') {
                $apiCurrency = $apiBank->chooseOneCurrency('USD');
                $value->convertedPrice = rtrim(round($value->cost*$apiCurrency['rate'],0),0);
            } elseif ($relatedGoods->currency == 'EUR') {
                $apiCurrency = $apiBank->chooseOneCurrency('EUR');
                $value->convertedPrice = rtrim(round($value->cost*$apiCurrency['rate'],0),0);
            } else {
                $value->convertedPrice = $value->cost;
            }
        }

        return view ('pages.goods-page', compact('model','marks', 'relatedGoods'));
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
