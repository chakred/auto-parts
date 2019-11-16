<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Auto_mark;
use Image as ImageCrop;
use App\Http\Requests\StoreMarkAutoRequest;
use App\ImageHandler\ImageHandler;

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
        return view ('admin.mark-auto.mark-auto', compact('marks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMarkAutoRequest $request)
    {
        $folderDirectoryName = 'marks';
        $image = ImageHandler::saveImage($request, $folderDirectoryName);

        Auto_mark::create([
            'name_mark' =>  $request->name_mark,
            'img_path' => $image,
            'slug' => str_slug($request->name_mark, '-')
        ]);
        return back();
    }
}
