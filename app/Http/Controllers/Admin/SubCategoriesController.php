<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Sub_category;
use Image as ImageCrop;


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

        return view('admin.sub-categories.index', compact('sub_categories', 'categories'));
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
        $this->validate($request,[
            "category" => "required",
            "sub_category" => "required|unique:sub_categories",
        ]);

        $new_sub_category = new Sub_category();
        $picture_name = null;

        if ($request->hasFile('picture')){
            $picture_name = '/sub-categories/'.uniqid().'-'.$request->file('picture')->getClientOriginalName();
            $new_sub_category->img_path = $picture_name;
            $request->picture->storeAs('public/upload', $picture_name);
        }

        $sub_category = $request->input('sub_category');
        $category_name = $request->input('category');
        $category_id = Category::select('id')->where('category', $category_name)->pluck('id')->toArray();
        $new_sub_category->sub_category = $sub_category;
        $new_sub_category->id_category = $category_id[0];
        $new_sub_category->slug = str_slug($sub_category, '-');
        $new_sub_category->save();

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
