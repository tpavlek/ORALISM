<?php

class ReportController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    $diagnoses = DB::table('radiology_record')->lists('diagnosis', 'diagnosis');
	  return View::make('report/index', array('diagnoses' => $diagnoses));	
	}

  public function generate() {
    $input = Input::only('start_date', 'end_date', 'diagnosis');

    $v = Report::validate($input);

    if (!$v->passes()) {
      return Redirect::route('report.index')->withInput()->withErrors($v);
    }
    $patients = Person::whereHas('records', function($query) use ($input) {
        $query->where('prescribing_date', '<=', $input['end_date']);
        $query->where('prescribing_date', '>=', $input['start_date']);
        $query->where('diagnosis', '=', $input['diagnosis']);
        })->get();

    return View::make('report/show', array('patients' => $patients, 
                                           'diagnosis' => $input['diagnosis']));
  }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
