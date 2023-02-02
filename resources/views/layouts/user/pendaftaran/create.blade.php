@extends('master.index')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/dist/css/alt/select2.min.css') }}">
@endpush

@section('breadcrumbs')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pendaftaran TOEFL</h1>
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
    <div class="callout callout-danger">
        <h4><i class="fas fa-exclamation-circle text-danger"></i> Salah!</h4>
        <p>This is a yellow callout.</p>
    </div>
    <div class="callout callout-warning">
        <h4><i class="fas fa-exclamation-triangle text-warning"></i> Peringatan!</h4>
        <p>This is a yellow callout.</p>
    </div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">
                Formulir Pendaftaran
            </h3>
        </div>
        <form action="{{ route('user.store') }}" method="POST">
        @csrf
            <div class="card-body">
                <h4>(<span class="text-danger">*</span>) Wajib di isi</h4>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input value="{{ old('nama') }}" name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Input Nama Mahasiswa" autocomplete="off">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>NIM <span class="text-danger">*</span></label>
                            <input value="{{ old('nim') }}" name="nim" type="text" class="form-control @error('nim') is-invalid @enderror" placeholder="Input NIM Mahasiswa" autocomplete="off">
                            @error('nim')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nomor Telepon <span class="text-danger">*</span></label>
                    <input value="{{ old('telepon') }}" name="telepon" type="text" class="form-control @error('telepon') is-invalid @enderror" placeholder="08**********" autocomplete="off">
                    @error('telepon')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input value="{{ old('email') }}" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Input Email Mahasiswa" autocomplete="off">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Pilih Semester <span class="text-danger">*</span></label>
                            <select class="form-control @error('semester') is-invalid @enderror" name="semester">
                                <option value="">--Pilih--</option>
                                <option {{ old('semester') == "semester 1" ? "selected" : "" }} value="semester 1">Semester I (Satu)</option>
                                <option {{ old('semester') == "semester 2" ? "selected" : "" }} value="semester 2">Semester II (Dua)</option>
                                <option {{ old('semester') == "semester 3" ? "selected" : "" }} value="semester 3">Semester III (Tiga)</option>
                                <option {{ old('semester') == "semester 4" ? "selected" : "" }} value="semester 4">Semester IV (Empat)</option>
                                <option {{ old('semester') == "semester 5" ? "selected" : "" }} value="semester 5">Semester V (Lima)</option>
                                <option {{ old('semester') == "semester 6" ? "selected" : "" }} value="semester 6">Semester VI (Enam)</option>
                                <option {{ old('semester') == "semester 7" ? "selected" : "" }} value="semester 7">Semester VII (Tujuh)</option>
                                <option {{ old('semester') == "semester 8" ? "selected" : "" }} value="semester 8">Semester VIII (Delapan)</option>
                            </select>
                            @error('semester')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Pilih bahasa TOEFL <span class="text-danger">*</span></label>
                            <select class="form-control @error('bahasa') is-invalid @enderror" name="bahasa">
                                <option value="">--Pilih--</option>
                                <option {{ old('bahasa') == "inggris" ? "selected" : "" }} value="inggris">Inggris</option>
                                <option {{ old('bahasa') == "jepang" ? "selected" : "" }} value="jepang">Jepang</option>
                            </select>
                            @error('bahasa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Jenis TOEFL <span class="text-danger">*</span></label>
                            <select class="form-control @error('jenis') is-invalid @enderror" name="jenis">
                                <option value="">--Pilih--</option>
                                <option {{ old('jenis') == "test" ? "selected" : "" }} value="test">Test</option>
                                <option {{ old('jenis') == "pelatihan" ? "selected" : "" }} value="pelatihan">Pelatihan</option>
                                <option {{ old('jenis') == "pelatihan dan test" ? "selected" : "" }} value="pelatihan dan test">Pelatihan dan Test</option>
                            </select>
                            @error('jenis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
@endpush