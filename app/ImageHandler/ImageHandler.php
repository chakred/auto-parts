<?php

namespace App\ImageHandler;
use Image as ImageCrop;


class ImageHandler
{

    /**
     * General method that saves image in storage and crops it
     *
     * @param $request
     * @param $file
     * @param $folderDirectoryName
     * @return null|string
     */
    public static function saveImage($request, $folderDirectoryName)
    {
        if ($request->has('picture')) {
            $file = $request->picture;
            $pictureName = '/'.$folderDirectoryName.'/'.uniqid().'-'.$file->getClientOriginalName();
            $request->picture->storeAs('/public/upload/', $pictureName);
            (new self)->cropImage($pictureName);
        }
        return isset($pictureName) ? $pictureName : null;

    }

    /**
     * This method searches for saved file and crops it
     *
     * @param $pictureName
     */
    private function cropImage($pictureName)
    {
        if (isset($pictureName) && $pictureName != null) {
            $img = ImageCrop::make(public_path('storage/upload' . $pictureName));
            $img->fit(200);
            $img->save();
        }
    }
}
