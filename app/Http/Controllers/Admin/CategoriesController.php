<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image as ImageCrop;

use App\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
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
            'category' => 'required|unique:categories',
        ]);

        $new_category = new Category();
        $new_category->category = $request->input('category');

        $picture_name = null;

        if ($request->hasFile('picture')){
            $picture_name = '/categories/'.uniqid().'-'.$request->file('picture')->getClientOriginalName();
            $new_category->img_path = $picture_name;
            $request->picture->storeAs('public/upload', $picture_name);
        }
        $new_category->slug = str_slug($request->input('category'), '-');
        $new_category->save();

        if (isset($picture_name)) {
            $img = ImageCrop::make(public_path('storage/upload' . $picture_name));
            $img->resize(null, 143, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();
        }

        return redirect('/admin/categories');
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
        $category = Category::find($id);
        $picture_name = null;

        if ($request->hasFile('picture')){
            $picture_name = '/categories/'.uniqid().'-'.$request->file('picture')->getClientOriginalName();
            $category->img_path = $picture_name;
            $request->picture->storeAs('public/upload', $picture_name);
        }
        $category->save();

        if (isset($picture_name)) {
            $img = ImageCrop::make(public_path('storage/upload' . $picture_name));
            $img->resize(null, 143, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();
        }

        return redirect('/admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        $category = Category::find($category);
//        dump( $model);
        $category->delete();
        return back();
    }
}
