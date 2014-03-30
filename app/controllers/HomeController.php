<?php

class HomeController extends BaseController {

	/**
	 * index 
	 * Displays the home page 
	 * @return View
	 */
	public function index()
	{
	  return View::make('index');
  }

}
