<?php

class PacsImage extends Eloquent {
  protected $table = "pacs_images";
  protected $primaryKey = "image_id";
  protected $id = "image_id";
  public $timestamps = false;
  protected $fillable = array('record_id', 'thumbnail', 'regular_size', 'full_size');
  protected $guarded = array('image_id');

  const THUMBNAIL = 0;
  const REGULAR_SIZE = 1;
  const FULL_SIZE = 2;

  public function record() {
    return $this->belongsTo('Record');
  }

  public function loadImage($image_real_path) {
    $image = Image::make($image_real_path);
    $this->full_size = base64_encode($image->encode('jpg', 80));
    $this->regular_size = base64_encode($image->resize(300, null, true, false)->encode('jpg', 80));
    $this->thumbnail = base64_encode($image->resize(50, null, true, false)->encode('jpg', 80));
    $this->save();
  }

  public function getPic($size) {
    if ($size == $this::THUMBNAIL) return $this->thumbnail;
    if ($size == $this::REGULAR_SIZE) return $this->regular_size;
    if ($size == $this::FULL_SIZE) return $this->full_size;
  }

  public static function validate($input) {
    $rules = array(
        'file' => 'required|image',
        );
    // We know there will be at least one file, so the foreach will execute
    $v = null;
    foreach ($input as $file)  {
      $v = Validator::make(array('file' => $file), $rules);
      if (!$v->passes()) return $v;
    }

    return $v;
  }

}
