<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Auto_mark;
use Image as ImageCrop;

class MarkAutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marks = Auto_mark::all();
        return view ('admin.mark-auto.mark-auto')->with(['marks' => $marks]);
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
            'name_mark' => 'required|unique:auto_marks'

        ]);

        $mark = new Auto_mark();
        $picture_name = null;

        if ($request->hasFile('picture')){
            $picture_name = '/marks/'.uniqid().'-'.$request->file('picture')->getClientOriginalName();
            $mark->img_path = $picture_name;
            $request->picture->storeAs('public/upload', $picture_name);
        }
        $mark->name_mark = $request->input('name_mark');
        $mark->slug = str_slug($mark->name_mark, '-');
        $mark->save();

        if (isset($picture_name)) {
            $img = ImageCrop::make(public_path('storage/upload' . $picture_name));
            $img->fit(200);
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
