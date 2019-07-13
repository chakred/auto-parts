<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{
    Good,
    Auto_model,
    Sub_category,
    FurtherSubCategory
};
use App\ApiBank\BankUkrainian;
use Image as ImageCrop;
use App\Calculation\PriceCalculation;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Auto_model::all();
        $goods = Good::all();
        $priceCalculation = new PriceCalculation();
        $goods = $priceCalculation->calculate($goods);
        return view('admin.goods.index', compact('models', 'goods'));
    }

    public function includeProfit($good)
    {
        $percentOfProfit = $good->cost/100*$good->profit;
        return $good->cost+$percentOfProfit;
    }

    public function includeDiscount($good)
    {
        $percentOfDiscount = $good->convertedPrice/100*$good->discount;
        return $good->convertedPrice-$percentOfDiscount;
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
        $furtherSubCategories = FurtherSubCategory::all();
        return view('admin.goods.create', compact('models', 'subCategories', 'furtherSubCategories', 'apiCurrencyUsd', 'apiCurrencyEur'));
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
        if ($request->input('further-sub-category') != 'null') {
            $good->id_further_sub_category = $request->input('further-sub-category');
        }
        $good->slug = str_slug($good->name_good, '-');
        $good->save();

        if (isset($picture_name)) {
            $img = ImageCrop::make(public_path('storage/upload'.$picture_name));
            $img->resize(null, 143, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();
        }

        return back()->withSuccess('You have just added - '.$good->name_good);

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
        $furtherSubCategories = FurtherSubCategory::all();
        return view ('admin.goods.edit', compact('good', 'models', 'subCategories', 'apiCurrencyUsd', 'apiCurrencyEur', 'furtherSubCategories'));
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
        if ($request->input('further-sub-category') != 'null') {
            $good->id_further_sub_category = $request->input('further-sub-category');
        }
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
