@extends('master.index')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/dist/css/alt/select2.min.css') }}">
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
                            <input type="text" class="form-control" readonly value="{{ ucwords(Auth::user()->profile->no_handphone) }}">
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
                            <input type="text" class="form-control" readonly value="{{ ucwords(Auth::user()->profile->program_studi) }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Semester</label>
                            <input type="text" class="form-control" readonly value="{{ ucwords(Auth::user()->profile->semester) }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group select-jenis">
                            <label>Jenis <span class="text-danger">*</span></label>
                            <select class="form-control @error('jenis') is-invalid @enderror" name="jenis">
                                <option value="" disabled selected>--Pilih jenis--</option>
                                @foreach ($jenisTOEFL as $item)
                                    <option {{ old('jenis') == $item->id ? "selected" : "" }} data-price="{{ $item->harga }}" value="{{ $item->id }}">{{ ucwords($item->bahasa) }} : {{ ucwords($item->jenis) }}</option>
                                @endforeach
                            </select>
                            @error('jenis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Periode <span class="text-danger">*</span></label>
                            <select class="form-control @error('periode') is-invalid @enderror" name="periode">
                                <option value="" disabled selected>--Pilih Periode--</option>
                                @foreach ($periode as $item)
                                    <option {{ old('periode') == $item->id ? "selected" : "" }} value="{{ $item->id }}">{{ ucwords($item->nama_periode) }}</option>
                                @endforeach
                            </select>
                            @error('periode')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Harga </label>
                        <input type="text" class="form-control form-control-lg price-input" placeholder="Rp. 0,-" readonly>
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
<script>
let formatter = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' });
$('.select-jenis').on('change', function() {
    $('.price-input').val(
        formatter.format($(this).find(':selected').data('price'))
    );
});
</script>
@endpush