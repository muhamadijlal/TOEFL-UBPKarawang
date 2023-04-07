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
                            <label>Pilih Semester <span class="text-danger">*</span></label>
                            <select class="form-control @error('semester') is-invalid @enderror" name="semester">
                                <option value="" disabled selected>--Pilih--</option>
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
                    <div class="col-6">
                        <div class="form-group select-jenis">
                            <label>Jenis TOEFL <span class="text-danger">*</span></label>
                            <select class="form-control @error('jenis') is-invalid @enderror" name="jenis">
                                <option value="" disabled selected>--Pilih--</option>
                                @foreach ($jenisTOEFL as $item)
                                    <option {{ old('jenis') == $item->id ? "selected" : "" }} data-price="{{ $item->harga }}" value="{{ $item->id }}">{{ $item->bahasa }} : {{ $item->jenis }}</option>
                                @endforeach
                            </select>
                            @error('jenis')
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
                        <input type="text" class="form-control price-input" placeholder="Rp. 0,-" readonly>
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