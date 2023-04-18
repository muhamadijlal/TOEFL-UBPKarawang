@extends('master.index')

@push('css')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css" />
@endpush

@section('title')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Master periode</h1>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')
  <div class="container-fluid">
    <div class="card card-primary">
      <form id="formPeriode">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="nama_periode">Nama periode <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_periode" name="nama_periode" placeholder="Berikan nama periode, contoh: Gelombang 1, dst.">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Date range <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control float-right" id="getRangeDate" name="rangeDate">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>Bahasa <span class="text-danger">*</span></label>
                <select class="form-control" name="bahasa">
                  <option disabled selected value="">-- Pilih bahasa --</option>
                  @foreach (array_unique($bahasa) as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Jenis <span class="text-danger">*</span></label>
                <select class="form-control" name="jenis">
                  <option disabled selected value="">-- Pilih jenis --</option>
                  @foreach (array_unique($jenis) as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row mt-4 px-2 float-right">
            <button type="submit" class="btn btn-primary text-end">Submit</button>
          </div>
        </div>
      </form>
    </div>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">List periode</h3>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-stripped" id="myTable" width="100%">
          <thead>
            <tr>
              <th>No.</th>
              <th>Bahasa</th>
              <th>Jenis</th>
              <th>Nama periode</th>
              <th>Tanggal mulai</th>
              <th>Tanggal berakhir</th>
              <th>Status aktif</th>
              <th>Aksi</th>
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
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/b-html5-2.2.3/datatables.min.js">
  </script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js">
  </script>
  // Date time picker
  <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <script>
    //Date range picker with time picker
    $('#getRangeDate').daterangepicker()
  </script>
  <script>

  const url = '{!! route("admin.periode.datatable") !!}';

  let table = null;

  $(document).ready( function () {
    table = $('#myTable').DataTable({
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
              {data: "DT_RowIndex"},
              {data: 'bahasa', name: 'bahasa'},
              {data: 'jenis', name: 'jenis'},
              {data: 'nama_periode', name: 'nama_periode'},
              {data: 'start_periode', name: 'start_periode'},
              {data: 'end_periode', name: 'end_periode'},
              {data: 'status', name: 'status'},
              {data: 'aksi', name: 'aksi'},
            ]
          });
    }); 


// Store data nama periode dan date time picker
  // Sweet alert
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    padding: '10px',
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  $('#formPeriode').submit(function(e) {
    e.preventDefault();
    var sendData = new FormData(this);

    $.ajax({
      url: "{!! route('admin.periode.store') !!}",
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": "{{ csrf_token() }}",
      },
      data: sendData,
      contentType: false,
      processData: false,
      dataType: 'json',
      beforeSend: function() {},
      success: function(response) {
        if(response.status_code == 200){
          Toast.fire({
            icon: response.status_message,
            title: response.message
          })
          table.draw();
        }else{
          Toast.fire({
            icon: response.status_message,
            title: response.message
          })
        }
      },
      error: function(response) {
        Toast.fire({
          icon: "error",
          title: response.responseJSON.message
        })
      },
      complete: function(response) {
        $("#nama_periode").val("");
        $('select').val('');
      }
    });
  })

  // Confirm delete function
  function confirmDelete(id) {
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
      title: 'Anda yakin ?',
      text: "Data akan dihapus!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Tidak, batalkan!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        // if confirmed
        $.ajax({
          url: "/admin/periode/destroy/"+id,
          type: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {
            if(response.status_code == 200){
              swalWithBootstrapButtons.fire(
                response.status_message,
                response.message,
                response.status_message
              )
            }else{
              swalWithBootstrapButtons.fire(
                response.status_message,
                response.message,
                response.status_message
              )
            }
          table.draw()
          }
        });
      }else{
        // if canceled
        swalWithBootstrapButtons.fire(
          'Hapus dibatalkan',
          'Data anda aman',
          'info'
        )
      };
    });
  }
</script>
@endpush
