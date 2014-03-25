<?php

class Report {
  
  public static function validate($input) {
    $rules = array('diagnosis' => 'Required|exists:radiology_record',
                   'start_date' => 'Required|date',
                   'end_date' => 'Required|date');

    return Validator::make($input, $rules);
  }
}
