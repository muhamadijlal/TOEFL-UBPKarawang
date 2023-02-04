@extends('master.index')

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css"/>
@endpush

@section('breadcrumbs')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')
<div class="container-fluid">
  @if(Auth::user()->nim == null && Auth::user()->phone == null)
  <div class="callout callout-warning">
    <h4>
      <i class="fas fa-exclamation-triangle text-warning"></i> 
      Peringatan!
    </h4>
    <p>Lengkapi dulu profil! <a href="#">Klik disini!</a></p>
  </div>
  @endif
  <div class="card">
    <div class="card-body">
      <table class="table table-bordered table-stripped"  id="myTable" width="100%">
        <thead>
            <tr>
              <th>Nama</th>
              <th>NIM</th>
              <th>Email</th>
              <th>Bahasa TOEFL</th>
              <th>Jenis TOEFL</th>
              <th>Nomor Telepon</th>
              <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Muhamad Haidar Ijlal</td>
                <td>18416255201201</td>
                <td>if18.muhamadijlal@mhs.ubpkarawang.ac.id</td>
                <td>Inggris</td>
                <td>Test & Pelatihan</td>
                <td>085156203033</td>
                <td>Belum Lunas</td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@push('js')
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/b-html5-2.2.3/datatables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script>
  $(document).ready( function () {
    $('#myTable').DataTable();
  });
</script>
@endpush