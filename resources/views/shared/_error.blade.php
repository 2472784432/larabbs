@if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul class="mt-1 mb-1">
      @foreach ($errors->all() as $error)
        <li><i class="glyphicon glyphicon-remove"></i> {{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
