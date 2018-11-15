<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Auto_mark;
use App\Auto_model;

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
        $model = new Auto_model();
        $mark_name = $request->input('mark_auto_select');
        $mark_id = Auto_mark::select('id_mark')->where('name_mark', $mark_name)->pluck('id_mark')->toArray();
        $model->name_model = $request->name_model;
        $model->id_mark = $mark_id[0];
        $model->year = $request->input('year');
        $model->engine = $request->input('value_engine');
        $model->type_of_engine = $request->input('type_engine');
        $model->transmission = $request->input('transmission');
        $model->type_of_transmission = $request->input('type_transmission');

        $model->save();

        return redirect('/admin');

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
        $model = Auto_model::find($id);
        $model->name_model = $request->input('name_model');
        $model->year = $request->input('year');
        $model->engine = $request->input('value_engine');
        $model->type_of_engine = $request->input('type_engine');
        $model->transmission = $request->input('transmission');
        $model->type_of_transmission = $request->input('type_transmission');

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
//        dump( $model);
        $model = Auto_model::find($model);
        $model->delete();
        return back();
    }

}
