<?php

class ImageController extends BaseController
{
    public function show($id, $img_size = PacsImage::REGULAR_SIZE)
    {
        $image = PacsImage::find($id);

        if ($img_size < PacsImage::THUMBNAIL || $img_size > PacsImage::FULL_SIZE) {
          $img_size = PacsImage::REGULAR_SIZE;
        }

        return View::make('image/show', array('id' => $id, 'image' => $image, "img_size" => $img_size));
    }
}
