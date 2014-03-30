<?php

class ImageController extends BaseController
{
    public function show($record_id, $image_id, $img_size = PacsImage::REGULAR_SIZE)
    {
        $image = PacsImage::where("record_id", $record_id)->where("image_id", $image_id)->firstOrFail();

        // adjust the size if out of bounds
        $img_size = intval($img_size);
        if($img_size < PacsImage::THUMBNAIL)
            return Redirect::route('image.show', array($record_id, $image_id, PacsImage::THUMBNAIL));
        if($img_size > PacsImage::FULL_SIZE)
            return Redirect::route('image.show', array($record_id, $image_id, PacsImage::FULL_SIZE));

        // security for viewing images
        $viewable = true;
        $user = Auth::user();
        if($user->class == 'p' &&
           $image->record->patient->person_id != $user->person_id)
        {
            $viewable = false;
        }
        else if($user->class == 'd')
        {
            // get all the family doctor ids
            $doctors = [];
            foreach($image->record->patient->doctors as $doctor)
                array_push($doctors, $doctor->person_id);

            // if not a family doctor, can't view it
            if(!in_array($user->person->person_id,
                         $doctors))
                $viewable = false;
        }
        else if($user->class == 'r' &&
                $image->record->radiologist->person_id != $user->person_id)
        {
            $viewable = false;
        }

        if($viewable)
            return View::make('image/show', array('record_id' => $record_id, 'image_id' => $image_id, 'image' => $image, "img_size" => $img_size));
        else
            return View::make('image/show', array('record_id' => $record_id, 'image_id' => $image_id, 'image' => $image, "img_size" => $img_size))->withErrors(array("You don't have permission to view this image."));
    }
}
