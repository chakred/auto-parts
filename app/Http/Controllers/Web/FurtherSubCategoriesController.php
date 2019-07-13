<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{
    Auto_model,
    Auto_mark,
    Sub_category,
    FurtherSubCategory,
    ViewCounter
};


class FurtherSubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ViewCounter $viewCounter)
    {
        $viewNumbers = $viewCounter->createCookie();
        $subCategoryId = $request->route('subCategory');
//        $categoryId = $request->route('category');
        $modelId = $request->route('model');
        $model = Auto_model::where('id','=',  $modelId)->first();
        $marks = Auto_mark::all();
        $furtherSubCategories = FurtherSubCategory::where('id_sub_category','=', $subCategoryId)->get();
        return view ('pages.further-sub-categories-page', compact('model','marks', 'furtherSubCategories', 'viewNumbers'));
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
