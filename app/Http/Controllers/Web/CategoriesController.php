<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Auto_model;
use App\Auto_mark;
use App\Good;
use App\Category;
use App\ViewCounter;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ViewCounter $viewCounter)
    {
        $viewNumbers = $viewCounter->createCookie();
        $modelId = $request->route('id');
        $model = Auto_model::where('id','=', $modelId)->first();
        $marks = Auto_mark::all();
        $relatedGoods = Good::where('id_model','=', $modelId)->get();

        $relCatCollection = array();

        foreach ($relatedGoods as $subCategory) {
            if (!in_array($subCategory->subCategories->category, $relCatCollection)) {
                $relCatCollection[] = $subCategory->subCategories->category;
            }
        }

        return view ('pages.categories-page', compact('model','marks', 'relCatCollection', 'viewNumbers'));
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
