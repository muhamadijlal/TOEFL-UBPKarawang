@extends('master.index')

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css"/>
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
  @if(session('success'))
    @include('components.alert-success', ['message' => session('success')])
  @endif
  <div class="card">
    <div class="card-body">
      <table class="table table-bordered table-stripped"  id="myTable" width="100%">
        <thead>
            <tr>
              <th>Nama</th>
              <th>NIM</th>
              <th>Email</th>
              <th>Semester</th>
              <th>Bahasa TOEFL</th>
              <th>Jenis TOEFL</th>
              <th>Status Pembayaran</th>
              <th>Invoice</th>
            </tr>
        </thead>
        <tbody></tbody>
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
    const url = '/dashboard/datatable';

    $('#myTable').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      ajax: {
        url: url,
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      },
      columns: [
        {data: 'nama', name: 'nama'},
        {data: 'nim', name: 'nim'},
        {data: 'email', name: 'email'},
        {data: 'semester', name: 'semester'},
        {data: 'bahasa', name: 'bahasa'},
        {data: 'jenis', name: 'jenis'},
        {data: 'status_pembayaran', name: 'status_pembayaran'},
        {data: 'invoice', name: 'invoice'},
      ]
    });
  });
</script>
@endpush