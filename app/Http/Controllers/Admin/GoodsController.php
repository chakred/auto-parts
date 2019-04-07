<?php

namespace App\Http\Controllers\Admin;

use App\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Auto_model;
use App\Sub_category;
use App\ApiBank\BankUkrainian;

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
        return view('admin.goods.index', compact('models', 'goods'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(BankUkrainian $apiBank)
    {
        $apiCurrency = $apiBank->chooseOneCurrency('USD');
        $models = Auto_model::all();
        $subCategories = Sub_category::all();
        return view('admin.goods.create', compact('models', 'subCategories', 'apiCurrency'));
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
        $good->discount = $request->input('discount');
        $good->currency = $request->input('currency');
        $good->quantity = $request->input('quantity');
        $good->item = $request->input('item');

        $good->id_model = $request->input('auto');
        $good->id_sub_category = $request->input('sub-category');
        $good->save();

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
    public function edit($id)
    {
        $good = Good::find($id);
        return view ('admin.goods.edit')->with('good', $good);
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
        $model = Good::find($id);
        $this->validate($request,[
            'name_good' => 'required',
            'desc_good' => 'required',
            'img_path' => 'image|nullable|max:1999',

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
        $good->discount = $request->input('discount');
        $good->currency = $request->input('currency');
        $good->quantity = $request->input('quantity');
        $good->item = $request->input('item');

        $good->id_model = $request->input('auto');
        $good->id_sub_category = $request->input('sub-category');

        $model->save();

        return redirect('/admin/model-auto');
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
