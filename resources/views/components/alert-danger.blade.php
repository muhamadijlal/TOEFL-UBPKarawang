<div class="callout callout-danger">
  <h4><i class="fas fa-exclamation-circle text-danger"></i> Salah!</h4>
  <ul>
  @foreach ($errors->all() as $error)
      <li class="text-danger">{{ $error }}</li>
  @endforeach
  </ul>
</div>