<?php

class RecordController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
    $patients = Person::whereHas('logins', function($query) {
          $query->where('class', '=', 'p');
        })->get();
	  return View::make('record/create', array('patients' => $patients));	
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$recordInput = Input::only('test_type',
                               'patient_id',
                               'doctor_id',
                               'radiologist_id',
                               'prescribing_date', 
                               'test_date', 
                               'diagnosis', 
                               'description');

    $v = Record::validate($recordInput);

    if (!$v->passes()) {
      return Redirect::route('record.create')->withInput()->withErrors($v);
    }

    $record = Record::create($recordInput);

    return Redirect::route('home');
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
		//
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
