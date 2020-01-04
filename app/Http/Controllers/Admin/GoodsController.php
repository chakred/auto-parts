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
use Image as ImageCrop;
use App\Calculation\PriceCalculation;
use App\CurrentCurrency;
use App\Http\Requests\StoreGoodsRequest;

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
        $goods = Good::orderBy('id', 'desc')->paginate(20);
        $priceCalculation = new PriceCalculation();
        $goods = $priceCalculation->calculate($goods);
        return view('admin.goods.index', compact('models', 'goods'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $currentCurrency = CurrentCurrency::all();
        $models = Auto_model::all();
        $subCategories = Sub_category::all();
        $furtherSubCategories = FurtherSubCategory::all();
        return view('admin.goods.create', compact('models', 'subCategories', 'furtherSubCategories', 'currentCurrency'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGoodsRequest $request
     * @return mixed
     */
    public function store(StoreGoodsRequest $request)
    {
        $good = new Good();
        $picture_name = null;

        if ($request->hasFile('picture')){
            $picture_name = '/goods/'.uniqid().'-'.$request->file('picture')->getClientOriginalName();
            $good->img_path = $picture_name;
            $request->picture->storeAs('public/upload', $picture_name);
        }

        $good->id_inner     = $request->input('inner_id') ? $request->input('inner_id') : null;
        $good->name_good    = $request->input('name_good');
        $good->desc_good    = $request->input('desc_good');
        $good->mark_good    = $request->input('mark_good');
        $good->country      = $request->input('country');
        $good->cost         = $request->input('cost');
        $good->profit       = $request->input('profit');
        $good->discount     = $request->input('discount');
        $good->currency     = $request->input('currency');
        $good->quantity     = $request->input('quantity');
        $good->item         = $request->input('item');

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currentCurrency = CurrentCurrency::all();
        $good = Good::find($id);
        $models = Auto_model::all();
        $subCategories = Sub_category::all();
        $furtherSubCategories = FurtherSubCategory::all();
        return view ('admin.goods.edit', compact('good', 'models', 'subCategories', 'currentCurrency', 'furtherSubCategories'));
    }

    /**
     * Update goods
     *
     * @param StoreGoodsRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(StoreGoodsRequest $request, $id)
    {
        $good = Good::find($id);
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
