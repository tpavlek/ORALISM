<?php

class LoginController extends BaseController
{
    /**
     * index 
     * Displays the login page 
     * @return void
     */
    public function index()
    {
      return View::make('login');
    }

    /**
     * verify 
     * Verifys the user's login data 
     * @return void
     */
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

    /**
     * logout 
     * Logs out the user 
     * @return void
     */
    public function logout() {
      //log the user out and return to home
      Auth::logout();
      return Redirect::route('home');
    }
}
