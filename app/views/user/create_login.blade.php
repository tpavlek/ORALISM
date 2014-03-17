@extends('layout')

@section('title')
New Login
@stop

@section('content')
@include('error')
{{ Form::open(array('route' => 'user.store_login', 'class' => 'pure-form pure-form-aligned')) }}

  <legend>New Login for user: {{ $person->first_name }} {{ $person->last_name }}</legend>
  {{ Form::hidden('person_id', $person->person_id) }}
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
