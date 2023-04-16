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
                  placeholder="Inggris, Jepang, mandarin, dst." value="{{ $item->bahasa }}">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="jenis">Jenis</label>
                <input type="text" class="form-control" id="jenis" name="jenis"
                  placeholder="Pelatihan, Test, Pelatihan dan Test." value="{{ $item->jenis }}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="harga">harga</label>
                <input type="text" class="form-control" id="currencyIDR" name="harga" placeholder="Rp. 100.000,-" value="@currency($item->harga)">
              </div>
            </div>
          </div>
          <div class="row mt-4 px-2 float-right" id="harga">
            <button type="submit" class="btn btn-primary text-end">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('js')
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="{{ asset('assets/dist/js/currency.js') }}"></script>
  <script>
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

    function redirect() {
      setTimeout(() => {
        location.href = '/admin/product';
      }, 3000);
    }

    $('#formProduct').submit(function(e) {
      e.preventDefault();
      var sendData = new FormData(this);

      $.ajax({
        url: "{!! route('admin.product.update',"$item->id") !!}",
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
          redirect()
        }
      });
    })
  </script>
@endpush
