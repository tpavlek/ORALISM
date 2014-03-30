<?php

class RecordController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
    $patients = Person::whereHas('logins', function($query) {
          $query->where('class', '=', 'p');
        })->get()->lists('full_name', 'person_id');
    $doctors = Person::whereHas('logins', function($query) {
          $query->where('class', '=', 'd');
        })->get()->lists('full_name', 'person_id');

	  return View::make('record/create', array('patients' => $patients,
                                             'doctors' => $doctors));	
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
    
    $files = Input::file('files');

    if ((count($files) == 1 && $files[0] == null) || count($files) == 0) {
      $record = Record::create($recordInput);
    } else {
      $v = PacsImage::validate($files);
      if (!$v->passes()) {
        return Redirect::route('record.create')->withInput()->withErrors($v);
      }
      
      $record = Record::create($recordInput);

      foreach ($files as $file) {
        $pacs = new PacsImage;
        $pacs->record_id = $record->record_id;
        $pacs->save();
        $pacs->loadImage($file->getRealPath());
      }

    }
    
    return Redirect::route('home');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, $img_size = PacsImage::REGULAR_SIZE)
	{
	  $record = Record::findOrFail($id);

    if ($img_size < PacsImage::THUMBNAIL)
      $img_size = PacsImage::THUMBNAIL;
    if ($img_size > PacsImage::FULL_SIZE) {
      $img_size = PacsImage::FULL_SIZE;
    }
    return View::make('record/show', array('record' => $record, 'img_size' => $img_size));
	}

}
