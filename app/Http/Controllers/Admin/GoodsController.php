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
use App\Http\Requests\StoreGoodsRequest;
use Image as ImageCrop;
use App\Calculation\PriceCalculation;
use App\CurrentCurrency;
use App\ImageHandler\ImageHandler;

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
        $goods = Good::paginate(20);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoodsRequest $request)
    {

        $folderDirectoryName = 'goods';
        $image = ImageHandler::saveImage($request, $folderDirectoryName, true);

        Good::create([
            'id_inner'  => $request->inner_id ? $request->inner_id : null,
            'name_good' => $request->name_good,
            'desc_good' => $request->desc_good,
            'img_path'  => $image,
            'mark_good' => $request->mark_good,
            'country'   => $request->country,
            'cost'      => $request->cost,
            'profit'    => $request->profit,
            'discount'  => $request->discount,
            'currency'  => $request->currency,
            'quantity'  => $request->quantity,
            'item'      => $request->item,
            'id_model'  => $request->auto,
            'id_sub_category' => $request->sub_category,
            'id_further_sub_category' => $request->further_sub_category != 'null' ? $request->further_sub_category : null,
            'slug'      => str_slug($request->name_good, '-')
        ]);
        return back()->withSuccess('Вы только что добавили - '.$request->name_good);

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGoodsRequest $request, $id)
    {

        $good = Good::find($id);
        $folderDirectoryName = 'goods';
        $image = ImageHandler::saveImage($request, $folderDirectoryName, true);

        $good->update([
            'id_inner'  => $request->inner_id ? $request->inner_id : null,
            'name_good' => $request->name_good,
            'desc_good' => $request->desc_good,
            'img_path'  => $image != null ? $image : $good->img_path,
            'mark_good' => $request->mark_good,
            'country'   => $request->country,
            'cost'      => $request->cost,
            'profit'    => $request->profit,
            'discount'  => $request->discount,
            'currency'  => $request->currency,
            'quantity'  => $request->quantity,
            'item'      => $request->item,
            'id_model'  => $request->auto,
            'id_sub_category' => $request->sub_category,
            'id_further_sub_category' => $request->further_sub_category != 'null' ? $request->further_sub_category : null,
            'slug'      => str_slug($request->name_good, '-')
        ]);
        return back()->withSuccess('Информация обновлена - '.$request->name_good);
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
