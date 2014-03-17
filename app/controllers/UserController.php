<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    $users = Person::all();

    return View::make('user/index', array('users' => $users));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
    
    return View::make('user/create');
  }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
    $personInput = Input::only('first_name', 'last_name', 'address', 'email', 'phone');

    $v = Person::validate($personInput);

    if (!$v->passes()) { 
      return Redirect::route('user.create')->withInput()->withErrors($v);
    }

    $userInput = Input::only('user_name', 'password', 'password_confirmation', 'class');

    $v = User::validate($userInput);

    if(!$v->passes()) {
      return Redirect::route('user.create')->withInput()->withErrors($v);
    }

    $person = Person::create($personInput);
    $userInput['person_id'] = $person->person_id;
    $userInput['password'] = Hash::make($userInput['password']);
    $user = User::create($userInput);
    $user->date_registered = new DateTime('NOW');
    $user->save();
    
    return Redirect::route('user.index');
	}

  public function create_login($id) {
    $person = Person::find($id);

    return View::make('user/create_login', array('person' => $person));
  }

  public function store_login() {
    $userInput = Input::only('user_name', 
                             'password', 
                             'password_confirmation', 
                             'class',
                             'person_id');
    $v = User::validate($userInput);

    if (!$v->passes()) {
      return Redirect::route('user.create_login', Input::get('person_id'))->withInput()->withErrors($v);
    }

    $userInput['password'] = Hash::make($userInput['password']);
    $user = User::create($userInput);
    $user->date_registered = new DateTime('NOW');
    $user->save();
    return Redirect::route('user.index');
  }

  public function add_doctor($user_id) {
    $patient = Person::findOrFail($user_id);
    $persons = Person::whereHas('logins', function($query) {
          $query->where('class', '=', 'd');
        });
    if ($persons->count() == 0) {
      $errors = array("There are currently no doctors registered in the system");
      return Redirect::route('user.index')->withErrors($errors);
    }
    $all_doctors = $persons->get()->lists('full_name', 'person_id');
    return View::make('user/add_doctor', array('patient' => $patient,
                                               'user_doctors' => $patient->doctors,
                                               'all_doctors' => $all_doctors));
  }

  public function remove_doctor($patient_id) {
    $patient = Person::findOrFail($patient_id);
    if (!Input::has('doctor_id')) {
      $errors = array('You must provide a doctor_id');
      return Redirect::route('user.add_doctor', $patient_id)->withErrors($errors);
    }
    $doctor_id = Input::get('doctor_id');
    $doctor = Person::findOrFail($doctor_id);

    if (!$patient->doctors->contains($doctor_id)) {
      $errors = array($doctor->full_name . " is not a doctor for " . $patient->full_name);
      return Redirect::route('user.add_doctor', $patient_id)->withErrors($errors);
    }

    $patient->doctors()->detach($doctor_id);
    return Redirect::route('user.add_doctor', $patient_id);

  }

  public function store_doctor() {
    $patient = Person::findOrFail(Input::get('patient_id'));
    $doctor = Person::findOrFail(Input::get('doctor_id'));

    if ($patient->doctors->contains($doctor->person_id)) {
      $errors = array ("That doctor is already the family doctor for that user");
      return Redirect::route('user.add_doctor', $patient->person_id)->withErrors($errors);
    }

    $patient->doctors()->attach($doctor->person_id);

    return Redirect::route('user.add_doctor', $patient->person_id);
  }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
	  $person = Person::find($id);

    if (Auth::user()->isAdmin()) {
      $logins = $person->logins;
    } else {
      $logins = array(Auth::user());
    }
    
    return View::make('user/edit', array('person' => $person, 'logins' => $logins));
  }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	  $person = Person::findOrFail($id);
    
    if (Input::has('first_name')) {
      $first_name = Input::get('first_name');
      if ($first_name != $person->first_name) {
        $personInput['first_name'] = $first_name;
      }
    }

    if (Input::has('last_name')) {
      $last_name = Input::get('last_name');
      if ($last_name != $person->last_name) {
        $personInput['last_name'] = $last_name;
      }
    }
  
    if (Input::has('address')) {
      $address = Input::get('address');
      if ($address != $person->address) {
        $personInput['address'] = $address;
      }
    }

    if (Input::has('email')) {
      $email = Input::get('email');
      if ($email != $person->email) {
        $personInput['email'] = $email;
      }
    }

    if (Input::has('phone')) {
      $phone = Input::get('phone');
      if ($phone != $person->phone) {
        $personInput['phone'] = $phone;
      }
    }

    $v = Person::validate($personInput);

    if (!$v->passes()) {
      return Redirect::route('user.edit', $person->person_id)->withErrors($v);
    }

    $person->fill($personInput);
    $person->save();

    return Redirect::route('user.edit', $person->person_id);
	}

  public function updateLogin($name) {
    $user = User::findOrFail($name);
    
    $inputArr = array();
    if (Input::has('user_name')) {
      $user_name = Input::get('user_name');
      
      if ($user_name != $user->user_name) {
        $inputArr['user_name'] = Input::get('user_name'); 
      }
    }

    if (Input::has('password')) {
      $password = Input::get('password');
      if ($password != null) {
        $user->password = Hash::make($password);
      }
    }

    if (Input::has('class')) {
      $class = Input::get('class');
      if ($class != $user->class) {
        $inputArr['class'] = $class;
      }
    }

    $v = User::validate($inputArr);

    if (!$v->passes()) {
      return Redirect::route('user.edit', $user->person->person_id)->withErrors($v);
    }

    foreach ($inputArr as $k => $v) {
      $user->$k = $v;
    }

    $user->save();

    return Redirect::route('user.edit', $user->person->person_id);
  }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
