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
          <h1 class="m-0">Master product</h1>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')
  <div class="container-fluid">
    <div class="card card-primary">
      <form id="formProduct">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="bahasa">Bahasa</label>
                <input type="text" class="form-control" id="bahasa" name="bahasa"
                  placeholder="Inggris, Jepang, mandarin, dst.">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="jenis">Jenis</label>
                <input type="text" class="form-control" id="jenis" name="jenis"
                  placeholder="Pelatihan, Test, Pelatihan dan Test.">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="harga">harga</label>
                <input type="text" class="form-control" id="currencyIDR" name="harga" placeholder="Rp. 100.000,-">
              </div>
            </div>
          </div>
          <div class="row mt-4 px-2 float-right" id="harga">
            <button type="submit" class="btn btn-primary text-end">Submit</button>
          </div>
        </div>
      </form>
    </div>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">List product</h3>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-stripped" id="myTable" width="100%">
          <thead>
            <tr>
              <th>No.</th>
              <th>Bahasa</th>
              <th>Jenis</th>
              <th>Harga</th>
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
  <script src="{{ asset('assets/dist/js/currency.js') }}"></script>
  <script>
    const url = '{!! route('admin.product.datatable') !!}';

    let table = null;

    $(document).ready(function() {
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
        columns: [{
            data: "DT_RowIndex"
          },
          {
            data: 'bahasa',
            name: 'bahasa'
          },
          {
            data: 'jenis',
            name: 'jenis'
          },
          {
            data: 'harga',
            name: 'harga'
          },
          {
            data: 'aksi',
            name: 'aksi'
          },
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

    $('#formProduct').submit(function(e) {
      e.preventDefault();
      var sendData = new FormData(this);

      $.ajax({
        url: "{!! route('admin.product.store') !!}",
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
          if (response.status_code == 200) {
            Toast.fire({
              icon: response.status_message,
              title: response.message
            })
            table.draw();
          } else {
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
          // $("#nama_periode").val("");
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
            url: "/admin/product/destroy/" + id,
            type: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              if (response.status_code == 200) {
                swalWithBootstrapButtons.fire(
                  response.status_message,
                  response.message,
                  response.status_message
                )
              } else {
                swalWithBootstrapButtons.fire(
                  response.status_message,
                  response.message,
                  response.status_message
                )
              }
              table.draw()
            }
          });
        } else {
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
