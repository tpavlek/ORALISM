<?php

class Person extends Eloquent {
 
  public $primaryKey = "person_id";
  
  protected $id = "person_id";
  protected $table = "persons";
  
  public $timestamps = false;
  protected $fillable = array('first_name', 'last_name', 'address', 'email', 'phone');
  protected $guarded = array('person_id');

  public function logins() {
    return $this->hasMany('User', 'person_id', 'person_id');
  }

  public static function validate($input) {
    $rules = array(
        'first_name' => 'Required|Between:3,24|Alpha',
        'last_name' => 'Required|Between:3,24|Alpha',
        'address' => 'Required|alpha_dash|Between:3,128',
        'email' => 'Required|email|Unique:persons|Between:3,128',
        'phone' => 'Required|Numeric|regex:/[0-9]{10,11}/',
        );

    $messages = array(
        'phone.regex' => "The phone number must be ten digits and entered without punctuation like
                    17804642624",
        );

    return Validator::make($input, $rules, $messages);
  }
}
