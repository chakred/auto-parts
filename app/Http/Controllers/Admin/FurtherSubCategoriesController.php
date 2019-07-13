<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{
    Sub_category,
    FurtherSubCategory
};
use Image as ImageCrop;


class FurtherSubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories = Sub_category::all();
        $further_sub_categories = FurtherSubCategory::all();
        return view('admin.further-sub-categories.index', compact('sub_categories', 'further_sub_categories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
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
            "sub_category" => "required",
            "further_sub_category" => "required|unique:further_sub_categories",
        ]);

        $new_further_sub_category = new FurtherSubCategory();
        $picture_name = null;

        if ($request->hasFile('picture')){
            $picture_name = '/further-sub-categories/'.uniqid().'-'.$request->file('picture')->getClientOriginalName();
            $new_further_sub_category->img_path = $picture_name;
            $request->picture->storeAs('public/upload', $picture_name);
        }

        $further_sub_category = $request->input('further_sub_category');
        $sub_category_name = $request->input('sub_category');

        $sub_category_id = Sub_category::select('id')->where('sub_category', $sub_category_name)->pluck('id')->toArray();
        $new_further_sub_category->further_sub_category = $further_sub_category;
        $new_further_sub_category->id_sub_category = $sub_category_id[0];
        $new_further_sub_category->slug = str_slug($further_sub_category, '-');
        $new_further_sub_category->save();

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
        $further_sub_category = FurtherSubCategory::find($id);
        $picture_name = null;

        if ($request->hasFile('picture')){
            $picture_name = '/further-sub-categories/'.uniqid().'-'.$request->file('picture')->getClientOriginalName();
            $further_sub_category->img_path = $picture_name;
            $request->picture->storeAs('public/upload', $picture_name);
        }
        $further_sub_category->save();

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
