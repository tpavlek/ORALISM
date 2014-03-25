<?php

class Person extends Eloquent {
  // Set the primary key of the table
  public $primaryKey = "person_id";
  // Set the id column of the table
  protected $id = "person_id";
  // Set the table name
  protected $table = "persons";
  // This class does not use timestamps
  public $timestamps = false;
  // Mass assignment variables that are whitelisted
  protected $fillable = array('first_name', 'last_name', 'address', 'email', 'phone');
  // Explicity blacklisted mass-assignment variables
  protected $guarded = array('person_id');

   /**
    * Gets the associated logins with the user 
    */
  public function logins() {
    return $this->hasMany('User', 'person_id', 'person_id');
  }

  /**
   * Gets the family doctors associated with the user
   */
  public function doctors() {
    return $this->belongsToMany('Person', 'family_doctor', 'patient_id', 'doctor_id');
  }

  /**
   * records 
   *  Gets the radiology_records associated with the user 
   * @access public
   * @return Eloquent Relationship containing the records 
   */
  public function records() {
    return $this->hasMany('Record', 'patient_id', 'person_id');
  }

  /**
   * date_of_diagnosis 
   * Gets the date of the first instance of a given diagnosis 
   * @param string $diagnosis 
   * @access public
   * @return string, the date of the first test. Exception thrown if none found 
   */
  public function date_of_diagnosis($diagnosis) {
    $records = $this->records()->where('diagnosis', '=', $diagnosis);
    if ($records->count() == 0) {
      throw new Exception("Diagnosis not found");
    }

    return $records->first()->test_date;
  }

  /**
   * getFullNameAttribute 
   * Getter for the user's full name accessed through $obj->first_name 
   * @access public
   * @return string first_name concatenated with last_name 
   */
  public function getFullNameAttribute() {
    return $this->first_name . " " .  $this->last_name;
  }

  /**
   * validate 
   * Validate given input with class-specific rules 
   * @param Assoc-Array $input
   * @static
   * @access public
   * @return Laravel Validator containing the result of the validatation 
   */
  public static function validate($input) {
    $rules = array(
        'first_name' => 'sometimes|Required|Between:3,24|Alpha',
        'last_name' => 'sometimes|Required|Between:3,24|Alpha',
        'address' => 'sometimes|Required|alpha_dash|Between:3,128',
        'email' => 'sometimes|Required|email|Unique:persons|Between:3,128',
        'phone' => 'sometimes|Required|Numeric|regex:/[0-9]{10,11}/',
        );

    $messages = array(
        'phone.regex' => "The phone number must be ten digits and entered without punctuation like
                    17804642624",
        );

    return Validator::make($input, $rules, $messages);
  }
}
