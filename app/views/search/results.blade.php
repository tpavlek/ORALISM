@extends('layout')

@section('title')
Search Results
@stop

@section('content')
<h2>Search Results</h2>

<script type='text/javascript'>
$(".clickableRow").click(function(){
    window.location = "http://stackoverflow.com/questions/12115550/html-clickable-table-rows";
});
</script>

@if(sizeof($records) == 0)
  <h2>No Results Found!</h2>
@else
  <table class="pure-table">
    <tr>
      <td>Patient</td>
      <td>Doctor</td>
      <td>Radiologist</td>
      <td>Test Type</td>
      <td>Prescribing Date</td>
      <td>Test Date</td>
      <td>Diagnosis</td>
      <td>Description</td>
      <td></td>
    </tr>
    @foreach ($records as $record)
    <tr class="clickableRow" href="www.example.com">
      <td>{{ $record->patient_first_name . " " . $record->patient_last_name }}</td>
      <td>{{ $record->doctor_first_name . " " . $record->doctor_last_name }}</td>
      <td>{{ $record->radiologist_first_name . " " . $record->radiologist_last_name }}</td>
      <td>{{ $record->test_type }}</td>
      <td>{{ $record->prescribing_date }}</td>
      <td>{{ $record->test_date }}</td>
      <td>{{ $record->diagnosis }}</td>
      <td>{{ $record->description }}</td>
      <td><form method="get">
          <input type="submit" formaction="{{ URL::route("record.show", array("id" => $record->record_id)) }}" value="View">
          </form>
      </td>
    </tr>
    @endforeach
  </table>
@endif
@stop
