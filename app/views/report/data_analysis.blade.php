@extends('layout')

@section('title')
Data Analysis
@stop

@section('content')
  @if (count($data) == 0)
    <p>No results to display</p>
  @else
  <table class="pure-table">
    <thead>
      <tr>
        <th>Period</th>
        <th>Image Count</th>
      </tr>
    </thead>
    @foreach($data as $group)
      <tr>
        <td>@if(property_exists($group, "time")) {{ $group->time }} @else NULL @endif</td>
        <td>{{ $group->img_total }}</td>
      </tr>
    @endforeach
  </table>
  @endif
  <div class="centered">
    <a href="{{ URL::route('report.analysis') }}" class='pure-button pure-button-good'>
      Search Again
    </a>
  </div>
@stop
