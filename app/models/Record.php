<?php

class Record extends Eloquent {
  public static $TEST_TYPES = array('smoke' => 'smoke', 'black_box' => 'black_box');
  protected $table = "radiology_record";
  protected $id = "record_id";
  protected $primaryKey = "record_id";
  public $timestamps = false;
  protected $guarded = array('record_id');
  protected $fillable = array('patient_id',
                              'doctor_id',
                              'radiologist_id',
                              'test_type',
                              'prescribing_date',
                              'test_date',
                              'diagnosis',
                              'description');

  /**
   * doctor 
   * 
   * @access public
   * @return void
   */
  public function doctor() {
    return $this->belongsTo('Person', 'doctor_id', 'person_id');
  }

  /**
   * radiologist 
   * 
   * @access public
   * @return void
   */
  public function radiologist() {
    return $this->belongsTo('Person', 'radiologist_id', 'person_id');
  }

  /**
   * patient 
   * 
   * @access public
   * @return Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function patient() {
    return $this->belongsTo('Person', 'patient_id', 'person_id');
  }

  /**
   * images 
   * 
   * @access public
   * @return Illuminate\Database\Eloquent\Relations\HasMany 
   */
  public function images() {
    return $this->hasMany('PacsImage');
  }

  /**
   * validate 
   * 
   * @param mixed $input 
   * @static
   * @access public
   * @return Illuminate\Validation\Validator 
   */
  public static function validate(array $input) {
    $rules = array(
                    'test_type' => 'Required|Between:3,24',
                    'prescribing_date' => 'Required|date',
                    'test_date' => 'Required|date',
                    'diagnosis' => 'Required|Between:3,128',
                    'description' => 'Required|Between:3,1024',
        );

    return Validator::make($input, $rules);
  }
}
