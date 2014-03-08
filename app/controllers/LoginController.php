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
        if(Auth::attempt(array('user_name' => $userName, 'password' => $password), true))
        {
            return Redirect::route('home');
        }
        else
        {
            return Redirect::route('login')->withErrors(array("Invalid username or password."));
        }
    }

    public function logout() {
      Auth::logout();
      return Redirect::route('home');
    }
}
