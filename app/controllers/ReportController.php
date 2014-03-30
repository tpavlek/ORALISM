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

  /**
   * generate  
   * Generates the requested report, based on the parameters provided
   * @return View
   */
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
   * analysis 
   * Displays the form to allow the user to perform data-mining 
   * @return View
   */
  public function analysis() {
    return View::make('report/analysis');
  }

  /**
   * analyze 
   * Performs data mining on the database based on provided parameters
   * @return View 
   */
  public function analyze() {
    if (!Input::has('search') || count(Input::get('search')) == 0 ) {
      $errors = array('You must select a property to filter by');
      return Redirect::route('report.analysis')->withInput()->withErrors($errors);
    }
    
    $search_topics = Input::get('search');
    $search_params = array();
    
    foreach ($search_topics as $search) {
      if (!Input::has($search) || Input::get($search) == null) {
        $errors = array("You did not specify a value for " . $search);
        return Redirect::route('report.analysis')->withInput()->withErrors($errors);
      } else {
        $search_params[$search] = Input::get($search);
      }
    }

    $base = DB::table('pacs_images')
              ->join('radiology_record', 
                     'pacs_images.record_id', 
                     '=', 
                     'radiology_record.record_id');

    if (array_key_exists("test_type", $search_params)) {
      $base = $base->where('radiology_record.test_type',
                           '=',
                           $search_params['test_type']);
    }

    if (array_key_exists('patient_id', $search_params)) {
      $base = $base->where('radiology_record.patient_id',
                           '=',
                           $search_params['patient_id']);
    }
    
    $select = array(DB::raw('count(pacs_images.image_id) as img_total'));

    if (array_key_exists('period', $search_params)) {
      switch ($search_params['period']) {
        case "weekly": 
          $select[] = DB::raw('YEARWEEK(radiology_record.test_date) as time');
            $base = $base->select($select)
               ->groupBy(DB::raw('YEARWEEK(radiology_record.test_date)'));
          break;
        case "monthly":
          $select[] = DB::raw('CONCAT(YEAR(test_date), MONTH(test_date)) as time');
          $base = $base->select($select)
            ->groupBy(DB::raw('YEAR(test_date), MONTH(test_date)'));
          break;
        case "yearly":
          $select[] = DB::raw('YEAR(test_date) as time');
          $base = $base->select($select)
            ->groupBy(DB::raw('YEAR(test_date)'));
          break;
      }
    } else {
      $base = $base->select($select);
    }

    return View::make('report.data_analysis', array('data' => $base->get()));
  }
	
}
