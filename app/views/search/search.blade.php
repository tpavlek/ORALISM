@extends('layout')

@section('title')
Search
@stop

@section('content')
  @include('error')
  {{ Form::open(array('route' => 'search.results', 'class' => 'pure-form pure-form-aligned')) }}
  <div class="pure-control-group">
    {{ Form::label('search') }}
    {{ Form::text('search') }}
  </div>
  <div class="pure-control-group">
    {{ Form::label('startDate') }}
    {{ Form::input('date', 'startDate') }}
  </div>
  <div class="pure-control-group">
    {{ Form::label('endDate') }}
    {{ Form::input('date', 'endDate') }}
  </div>
  <div class="pure-control-group">
    {{ Form::label('sorting') }}
    {{ Form::select('sorting', array('relevance' => 'relevance',
                                     'recent_first' => 'most-recent-first',
                                     'recent_last' => 'most-recent-last'))
    }}
  </div>
  
  <div class="pure-controls">
    <input type='submit' value='Search' class="pure-button pure-button-good" />
  </div>
  {{ Form::close() }}
@stop
