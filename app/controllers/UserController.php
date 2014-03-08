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
      $logins == Auth::user();
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
		//
	}

  public function updateLogin($name) {
    
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
