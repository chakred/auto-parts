<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use App\Sub_category;


class SubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories = Sub_category::all();
        $categories = Category::all();

        return view('admin.sub-categories.index')->with(['sub_categories' =>  $sub_categories, 'categories' => $categories]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
//        $marks = Auto_mark::select(['name_mark'])->get();
//        return view ('admin.model-auto.create')->with(['marks' => $marks]);
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
        $new_sub_category = new Sub_category();
        $picture_name = null;

        if ($request->hasFile('picture')){

            $picture_name = '/sub-categories/'.uniqid().'-'.$request->file('picture')->getClientOriginalName();
            $new_sub_category->img_path = $picture_name;
            $request->picture->storeAs('public/upload', $picture_name);
        }

        $sub_category = $request->input('sub-category');
        $category_name = $request->input('category');
        $category_id = Category::select('id')->where('category', $category_name)->pluck('id')->toArray();

        $new_sub_category->sub_category = $sub_category;
        $new_sub_category->id_category = $category_id[0];

        $new_sub_category->save();
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
