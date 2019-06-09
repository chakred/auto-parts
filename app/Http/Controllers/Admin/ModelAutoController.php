<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Auto_mark;
use App\Auto_model;
use Image as ImageCrop;

class ModelAutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Auto_model::all();
        return view ('admin.model-auto.index')->with(['models' => $models]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $marks = Auto_mark::select(['name_mark'])->get();
        return view ('admin.model-auto.create')->with(['marks' => $marks]);
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
            'name_model' => 'required',
            'year' => 'required',
            'value_engine' => 'required',
            'type_engine' => 'required',
            'transmission' => 'required',
            'type_transmission' => 'nullable'
        ]);

        $model = new Auto_model();
        $picture_name = null;

        if ($request->hasFile('picture')) {
            $picture_name = '/models/'.uniqid().'-'.$request->file('picture')->getClientOriginalName();
            $model->img_path = $picture_name;
            $request->picture->storeAs('public/upload', $picture_name);
        }

        $mark_name = $request->input('mark_auto_select');
        $mark_id = Auto_mark::select('id')->where('name_mark', $mark_name)->pluck('id')->first();
        $model->name_model = $request->name_model;
        $model->auto_mark_id = $mark_id;
        $model->year = $request->input('year');
        $model->last_year = $request->input('last_year')?$request->input('last_year'):null;
        $model->engine = $request->input('value_engine');
        $model->type_of_engine = $request->input('type_engine');
        $model->transmission = $request->input('transmission');
        $model->type_of_transmission = $request->input('type_transmission');
        $model->slug = str_slug($model->name_model, '-');
        $model->save();

        if (isset($picture_name)) {
            $img = ImageCrop::make(public_path('storage/upload' . $picture_name));
            $img->resize(null, 143, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save();
        }

        return redirect('/admin/model-auto');
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
        $model = Auto_model::find($id);
        return view ('admin.model-auto.edit')->with('model', $model);
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
        $this->validate($request,[
            'name_model' => 'required',
            'year' => 'required',
            'value_engine' => 'required',
            'type_engine' => 'required',
            'transmission' => 'required',
            'type_transmission' => 'nullable'
        ]);

        $model = Auto_model::find($id);
        $picture_name = null;

        if ($request->hasFile('picture')) {
            $picture_name = '/models/'.uniqid().'-'.$request->file('picture')->getClientOriginalName();
            $model->img_path = $picture_name;
            $request->picture->storeAs('public/upload', $picture_name);
        }

        $model->name_model = $request->input('name_model');
        $model->year = $request->input('year');
        $model->last_year = $request->input('last_year')?$request->input('last_year'):null;
        $model->engine = $request->input('value_engine');
        $model->type_of_engine = $request->input('type_engine');
        $model->transmission = $request->input('transmission');
        $model->type_of_transmission = $request->input('type_transmission');
        $model->slug = str_slug($model->name_model, '-');

        $model->save();

        return redirect('/admin/model-auto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($model)
    {
        $model = Auto_model::find($model);
        $model->delete();
        return back();
    }

}
