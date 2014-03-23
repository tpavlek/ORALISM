<?php

class ImageController extends BaseController
{
    public function show($record_id, $image_id, $img_size = PacsImage::REGULAR_SIZE)
    {
        $image = PacsImage::where("record_id", $record_id)->where("image_id", $image_id)->firstOrFail();

        if ($img_size < PacsImage::THUMBNAIL || $img_size > PacsImage::FULL_SIZE) {
          $img_size = PacsImage::REGULAR_SIZE;
        }

        $viewable = true;
        $user = Auth::user();
        if($user->class == 'p' && $image->record->patient->person_id != $user->person_id)
            $viewable = false;
        else if($user->class == 'd' && $image->record->doctor->person_id != $user->person_id)
            $viewable = false;
        else if($user->class == 'r' && $image->record->radiologist->person_id != $user->person_id)
            $viewable = false;

        if($viewable)
            return View::make('image/show', array('record_id' => $record_id, 'image_id' => $image_id, 'image' => $image, "img_size" => $img_size));
        else
            return View::make('image/show', array('record_id' => $record_id, 'image_id' => $image_id, 'image' => $image, "img_size" => $img_size))->withErrors(array("You don't have permission to view this image."));
    }
}
