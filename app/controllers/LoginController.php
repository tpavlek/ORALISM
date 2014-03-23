<?php

class LoginController extends BaseController
{
    public function index()
    {
      return View::make('login');
    }

    public function verify()
    {
        $userName = Input::get("userName");
        $password = Input::get("password");

        // if the login information is valid, redirect to home
        if(Auth::attempt(array('user_name' => $userName, 'password' => $password), true))
        {
            return Redirect::route('home');
        }
        else // otherwise return to the login screen with errors
        {
            return Redirect::route('login')->withErrors(array("Invalid username or password."));
        }
    }

    public function logout() {
      //log the user out and return to home
      Auth::logout();
      return Redirect::route('home');
    }
}
