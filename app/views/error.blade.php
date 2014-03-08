@if($errors->count() > 0)
  <div class="error-box">
    <h2>Errors occurred!</h2>
    <ul>
      @foreach ($errors->all() as $message)
        <li>{{ $message }}</li>
      @endforeach
    </ul>
  </div>
@endif
