<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
  
  public static function classes() {
    return array('a' => "Administrator", 
                                 'd' => "Doctor", 
                                 'p' => "Patient", 
                                 'r' => "Radiologist");
  }
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

  protected $primaryKey = 'user_name';

  public $incrementing = false;
  public $timestamps = false;
  
  protected $fillable = array('user_name', 'password', 'class', 'person_id');

  protected $guarded = array();
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

  public function person() {
    return $this->belongsTo('Person');
  }

  public function isAdmin() {
    return $this->class == 'a';
  }

  public function isRadiologist() {
    return $this->class == 'r';
  }

  public static function validate($input) {
    $rules = array(
      'user_name' => 'Required|unique:users|alpha_num|Between:3,24',
      'password' => 'Required|confirmed|Between:3,24',
      'class' => 'Required|In:a,d,p,r',
      );
    return Validator::make($input, $rules);
  }

}
