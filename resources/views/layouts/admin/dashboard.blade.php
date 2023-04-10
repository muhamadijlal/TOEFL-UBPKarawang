@extends('master.index')

@push('css')
    
@endpush

@section('title')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>0</h3>
            <p>Total pendaftaran Toefl Inggris</p>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>0</h3>
            <p>Total pendaftaran Toefl Jepang</p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
    
@endpush