<?php

namespace App\Http\Controllers\Admin;

use App\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Auto_model;
use App\Sub_category;
use App\ApiBank\BankUkrainian;
use Image as ImageCrop;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BankUkrainian $apiBank)
    {
        $models = Auto_model::all();
        $goods = Good::all();

        foreach ($goods as $good) {
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

        return view('admin.goods.index', compact('models', 'goods'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(BankUkrainian $apiBank)
    {
        $apiCurrencyUsd = $apiBank->chooseOneCurrency('USD');
        $apiCurrencyEur = $apiBank->chooseOneCurrency('EUR');
        $models = Auto_model::all();
        $subCategories = Sub_category::all();
        return view('admin.goods.create', compact('models', 'subCategories', 'apiCurrencyUsd', 'apiCurrencyEur'));
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
        $this->validate($request,[
            'name_good' => 'required',
            'desc_good' => 'required',
            'img_path' => 'image|nullable|max:1999',
            'mark_good' => 'required',
            'country' =>'required',
            'cost' => 'required',
            'profit' => 'required',
            'currency' => 'required',
            'quantity' => 'required',
            'auto' => 'required',
            'sub-category' => 'required'
        ]);

        $good = new Good();
        $picture_name = null;

        if ($request->hasFile('picture')){
            $picture_name = '/goods/'.uniqid().'-'.$request->file('picture')->getClientOriginalName();
            $good->img_path = $picture_name;
            $request->picture->storeAs('public/upload', $picture_name);
        }

        $good->id_inner = $request->input('inner_id') ? $request->input('inner_id') : null;
        $good->name_good = $request->input('name_good');
        $good->desc_good = $request->input('desc_good');
        $good->mark_good = $request->input('mark_good');
        $good->country = $request->input('country');
        $good->cost = $request->input('cost');
        $good->profit = $request->input('profit');
        $good->discount = $request->input('discount');
        $good->currency = $request->input('currency');
        $good->quantity = $request->input('quantity');
        $good->item = $request->input('item');

        $good->id_model = $request->input('auto');
        $good->id_sub_category = $request->input('sub-category');
        $good->slug = str_slug($good->name_good, '-');

        $good->save();

        if (isset($picture_name)) {
            $img = ImageCrop::make(public_path('storage/upload'.$picture_name));
            $img->resize(null, 143, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();
        }

        return back();

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
    public function edit($id, BankUkrainian $apiBank)
    {
        $apiCurrencyUsd = $apiBank->chooseOneCurrency('USD');
        $apiCurrencyEur = $apiBank->chooseOneCurrency('EUR');
        $good = Good::find($id);
        $models = Auto_model::all();
        $subCategories = Sub_category::all();
        return view ('admin.goods.edit', compact('good', 'models', 'subCategories', 'apiCurrencyUsd', 'apiCurrencyEur'));
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

        $good = Good::find($id);
        $this->validate($request,[
            'name_good' => 'required',
            'desc_good' => 'required',
            'img_path' => 'image|nullable|max:1999',
            'mark_good' => 'required',
            'country' =>'required',
            'cost' => 'required',
            'profit' => 'required',
            'currency' => 'required',
            'quantity' => 'required',
            'auto' => 'required',
            'sub-category' => 'required'
        ]);

        $picture_name = null;

        if ($request->hasFile('picture')){
            $picture_name = '/goods/'.uniqid().'-'.$request->file('picture')->getClientOriginalName();
            $good->img_path = $picture_name;
            $request->picture->storeAs('public/upload', $picture_name);
        }

        $good->id_inner = $request->input('inner_id') ? $request->input('inner_id') : null;
        $good->name_good = $request->input('name_good');
        $good->desc_good = $request->input('desc_good');
        $good->mark_good = $request->input('mark_good');
        $good->country = $request->input('country');
        $good->cost = $request->input('cost');
        $good->profit = $request->input('profit');
        $good->discount = $request->input('discount');
        $good->currency = $request->input('currency');
        $good->quantity = $request->input('quantity');
        $good->item = $request->input('item');

        $good->id_model = $request->input('auto');
        $good->id_sub_category = $request->input('sub-category');
        $good->slug = str_slug($good->name_good, '-');

        if (isset($picture_name)) {
            $img = ImageCrop::make(public_path('storage/upload'.$picture_name));
            $img->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();
        }

        $good->save();

        return redirect('/admin/goods');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $good = Good::find($id);
        $good->delete();
        return back();
    }
}
