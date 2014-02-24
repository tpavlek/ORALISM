<?php

class LoginController extends BaseController
{
    public function getIndex()
    {
        if(Auth::check())
        {
            return Redirect::to('home');
        }
        else
        {
            $message = '';
            if(Session::has('message'))
                $message = Session::get('message');

            return View::make('login', array('submit' => URL::action("LoginController@verify"), 'message' => $message));
        }
    }

    public function verify()
    {
        $userName = Input::get("userName");
        $password = Input::get("password");
        if(Auth::attempt(array('user_name' => $userName, 'password' => $password), true))
        {
            return Redirect::to('home');
        }
        else
        {
            return Redirect::to('login')->with('message', '<br>Invalid username or password.');
        }
    }
}
