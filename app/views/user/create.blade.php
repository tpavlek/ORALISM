@extends('layout')

@section('title')
Create User
@stop

@section('content')
@include('error')
{{ Form::open(array('route' => 'user.store', 'class' => 'pure-form pure-form-aligned')) }}
  <div class="pure-control-group">
    {{ Form::label('first_name') }}
    {{ Form::text('first_name') }}
  </div>

  <div class="pure-control-group">
    {{ Form::label('last_name') }}
    {{ Form::text('last_name') }}
  </div>

  <div class="pure-control-group">
    {{ Form::label('address') }}
    {{ Form::text('address') }}
  </div>

  <div class="pure-control-group">
    {{ Form::label('email') }}
    {{ Form::input('email', 'email') }}
  </div>

  <div class="pure-control-group">
    {{ Form::label('phone') }}
    {{ Form::input('tel','phone') }}
  </div>

  <div class="pure-control-group">
    {{ Form::label('user_name') }}
    {{ Form::text('user_name') }}
  </div>

  <div class="pure-control-group">
    {{ Form::label('password') }}
    {{ Form::password('password') }}
  </div>

  <div class="pure-control-group">
    {{ Form::label('password_confirmation', "Confirm Password") }}
    {{ Form::password('password_confirmation') }}
  </div>

  <div class="pure-control-group">
    {{ Form::label('class') }}
    {{ Form::select('class', User::classes()) }}
  </div>

  <div class="pure-controls">
    <input type="submit" class="pure-button pure-button-good" value="Save" />
    <a href="{{ URL::route('user.index') }}" class="pure-button pure-button-cancel">Cancel</a>
  </div>

{{ Form::close() }}

@stop
