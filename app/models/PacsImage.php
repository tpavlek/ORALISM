<?php

class PacsImage extends Eloquent {
  // Set  the table name
  protected $table = "pacs_images";
  // Set the primary key attribute
  protected $primaryKey = "image_id";
  // Set the id column of the table
  protected $id = "image_id";
  // This class does not use timestamps
  public $timestamps = false;
  // whitelisted mass-assignment variables
  protected $fillable = array('record_id', 'thumbnail', 'regular_size', 'full_size');
  // explicitly blacklisted mass-assignemnt variables
  protected $guarded = array('image_id');

  // Constancts that represent BLOB size.
  const THUMBNAIL = 0;
  const REGULAR_SIZE = 1;
  const FULL_SIZE = 2;

  /**
   * record 
   * Gets the Record associated with the image 
   * @access public
   * @return Eloquent Relationship containing the record 
   */
  public function record() {
    return $this->belongsTo('Record');
  }

  /**
   * loadImage 
   * Populates the blob columns of the image with formatted and resized images 
   * @param string $image_real_path 
   * @access public
   * @return void
   */
  public function loadImage($image_real_path) {
    $image = Image::make($image_real_path);
    $this->full_size = base64_encode($image->encode('jpg', 80));
    $this->regular_size = base64_encode($image->resize(300, null, true, false)->encode('jpg', 80));
    $this->thumbnail = base64_encode($image->resize(50, null, true, false)->encode('jpg', 80));
    $this->save();
  }

  /**
   * getPic 
   * Gets the associated blob column based on a provided input of a class constant 
   * @param int $size 
   * @access public
   * @return string blob from database representing the requested image size 
   */
  public function getPic($size) {
    if ($size == $this::THUMBNAIL) return $this->thumbnail;
    if ($size == $this::REGULAR_SIZE) return $this->regular_size;
    if ($size == $this::FULL_SIZE) return $this->full_size;

    return $this->regular_size;
  }

  /**
   * validate 
   * Validates input based on class busines logic
   *
   * @param array $input 
   * @static
   * @access public
   * @return Illuminate\Validation\Validator  
   */
  public static function validate(array $input) {
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
