@extends('layout')

@section('title')
View Report
@stop

@section('content')
<table class="pure-table">
  <thead>
    <tr>
      <th>Name</th>
      <th>Address</th>
      <th>Phone #</th>
      <th>Testing Date</th>
    </tr>
  </thead>
  @foreach ($patients as $patient)
    <tr>
      <td>{{ $patient->full_name }}</td>
      <td>{{ $patient->address }}</td>
      <td>{{ $patient->phone }}</td>
      <td>{{ $patient->date_of_diagnosis($diagnosis) }}</td>
    </tr>
  @endforeach
</table>

<div class="centered">
  <p>
    <a href="{{ URL::route('report.index') }}" class="pure-button pure-button-good">
      Generate Another
    </a>
  </p>
</div>
@stop
