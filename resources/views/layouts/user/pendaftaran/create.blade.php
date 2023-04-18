@extends('master.index')

@push('css')
  <link rel="stylesheet" href="{{ asset('assets/dist/css/alt/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugin/select2/css/select2.min.css') }}">
  <style>
    .select2-selection__rendered {
      line-height: 31px !important;
    }
    .select2-container .select2-selection--single {
      height: 38px !important;
    }
    .select2-selection__arrow {
      height: 34px !important;
    }
  </style>
@endpush

@section('title')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pendaftaran TOEFL</h1>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')
  @if($errors->any())
    @include('components.alert-danger', ['errors' => $errors->all()])
  @endif
  <div class="container-fluid">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">
          Formulir Pendaftaran
        </h3>
      </div>
      <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" readonly value="{{ ucwords(Auth::user()->nama) }}">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>NIM</label>
                <input type="text" class="form-control" readonly value="{{ ucwords(Auth::user()->profile->nim) }}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>Nomor Handphone</label>
                <input type="text" class="form-control" readonly
                  value="{{ ucwords(Auth::user()->profile->no_handphone) }}">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" readonly value="{{ ucwords(Auth::user()->email) }}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>Program Studi</label>
                <input type="text" class="form-control" readonly
                  value="{{ ucwords(Auth::user()->profile->program_studi) }}">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Semester</label>
                <input type="text" class="form-control" readonly
                  value="{{ ucwords(Auth::user()->profile->semester) }}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label>Pelatihan <span class="text-danger">*</span></label>
                <select name="pelatihan" class="form-control select" style="width: 100%;" tabindex="-1" aria-hidden="true" id="select-pelatihan">
                  <option value="" disabled selected>--Pilih Pelatihan--</option>
                  @foreach ($labels as $label)
                    <optgroup label="{{ $label->nama_periode }}">
                      @foreach ($periode as $item)
                        @if($label->nama_periode == $item->nama_periode)
                          <option {{ old('pelatihan') == $item->id ? "selected" : "" }} data-price="{{ $item->product->harga }}" value="{{ $item->id }}">{{ ucwords($item->product->bahasa) }} : {{ ucwords($item->product->jenis) }} ({{ date('d M Y', strtotime($item->start_periode)) }} - {{ date('d M Y', strtotime($item->end_periode)) }})</option>
                        @endif
                      @endforeach
                    </optgroup>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Harga <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-lg price-input font-weight-bold" placeholder="Rp. 0,-" readonly>
              </div>
            </div>
          </div>
          <div class="row mt-4 px-2 float-right">
            <button type="submit" class="btn btn-primary text-end">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('js')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
  <script>
    //Initialize Select2 Elements
    $('.select').select2();

    // Format currency
    let formatter = new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR'
    });
    $('#select-pelatihan').on('change', function() {
      $('.price-input').val(
        formatter.format($(this).find(':selected').data('price'))
      );
    });
  </script>
@endpush
