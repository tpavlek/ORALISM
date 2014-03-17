<?php

class Record extends Eloquent {
  protected $guarded = array('record_id');
  protected $fillable = array('patient_id',
                              'doctor_id',
                              'radiologist_id',
                              'test_type',
                              'prescribing_date',
                              'test_date',
                              'diagnosis',
                              'description');

  public function doctor() {
    return $this->belongsTo('Person', 'person_id', 'doctor_id');
  }

  public function radiologist() {
    return $this->belongsTo('Person', 'person_id', 'radiologist_id');
  }

  public function patient() {
    return $this->belongsTo('Person', 'person_id', 'patient_id');
  }

  public static function validate($input) {
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
