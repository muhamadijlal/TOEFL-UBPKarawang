@extends('master.index')

@push('css')
@endpush

@section('title')
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">User profile</h1>
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
    <div class="row">
      <!-- Update profile -->
      <div class="col-md-8">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              Update Profile
            </h3>
          </div>
          <form action="{{ route('user.profile.update', $user->id) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="no_handphone">Nomor Handphone <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('no_handphone') is-invalid @enderror" id="no_handphone" placeholder="08XX XXXX XXXX" value="{{ old('no_handphone') }}" name="no_handphone">
                @error('no_handphone')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Pilih Semester <span class="text-danger">*</span></label>
                    <select class="form-control @error('semester') is-invalid @enderror" name="semester">
                      <option value="" disabled selected>--Pilih Semester--</option>
                      <option {{ old('semester') == 'semester 1' ? 'selected' : '' }} value="semester 1">Semester I (Satu)</option>
                      <option {{ old('semester') == 'semester 2' ? 'selected' : '' }} value="semester 2">Semester II (Dua)</option>
                      <option {{ old('semester') == 'semester 3' ? 'selected' : '' }} value="semester 3">Semester III (Tiga)</option>
                      <option {{ old('semester') == 'semester 4' ? 'selected' : '' }} value="semester 4">Semester IV (Empat)</option>
                      <option {{ old('semester') == 'semester 5' ? 'selected' : '' }} value="semester 5">Semester V (Lima)</option>
                      <option {{ old('semester') == 'semester 6' ? 'selected' : '' }} value="semester 6">Semester VI (Enam)</option>
                      <option {{ old('semester') == 'semester 7' ? 'selected' : '' }} value="semester 7">Semester VII (Tujuh)</option>
                      <option {{ old('semester') == 'semester 8' ? 'selected' : '' }} value="semester 8">Semester VIII (Delapan)</option>
                    </select>
                    @error('semester')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>Pilih program studi <span class="text-danger">*</span></label>
                    <select class="form-control @error('program_studi') is-invalid @enderror" name="program_studi">
                      <option value="" disabled selected>--Pilih Program Studi--</option>
                      <option {{ old('program_studi') == 'Teknik Informatika' ? 'selected' : '' }} value="Teknik Informatika">Teknik Informatika</option>
                      <option {{ old('program_studi') == 'Teknik Mesin' ? 'selected' : '' }} value="Teknik Mesin">Teknik Mesin</option>
                      <option {{ old('program_studi') == 'Teknik Industri' ? 'selected' : '' }} value="Teknik Industri">Teknik Industri</option>
                      <option {{ old('program_studi') == 'Farmasi' ? 'selected' : '' }} value="Farmasi">Farmasi</option>
                      <option {{ old('program_studi') == 'Psikologi' ? 'selected' : '' }} value="Psikologi">Psikologi</option>
                      <option {{ old('program_studi') == 'Sistem Informasi' ? 'selected' : '' }} value="Sistem Informasi">Sistem Informasi</option>
                      <option {{ old('program_studi') == 'Manajemen' ? 'selected' : '' }} value="Manajemen">Manajemen</option>
                      <option {{ old('program_studi') == 'Akuntansi' ? 'selected' : '' }} value="Akuntansi">Akuntansi</option>
                      <option {{ old('program_studi') == 'Pendidikan Guru Sekolah Dasar' ? 'selected' : '' }} value="Pendidikan Guru Sekolah Dasar">Pendidikan Guru Sekolah Dasar</option>
                      <option {{ old('program_studi') == 'Pendidikan Agama Islam' ? 'selected' : '' }} value="Pendidikan Agama Islam">Pendidikan Agama Islam</option>
                      <option {{ old('program_studi') == 'Hukum' ? 'selected' : '' }} value="Hukum">Hukum</option>
                    </select>
                    @error('program_studi')
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
      <!-- Profile -->
      <div class="col-md-4">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="{{ asset('assets/dist/img/avatar.jpg') }}"
                alt="User profile picture">
            </div>
            <h3 class="profile-username text-center">{{ ucwords($user->nama) }}</h3>
            <p class="text-muted text-center">{{ ucwords($user->role) }}</p>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>NIM : </b>{{ $user->profile->nim ?? 'empty' }}
              </li>
              <li class="list-group-item">
                <b>No Handphone : </b>{{ $user->profile->no_handphone ?? 'empty' }}
              </li>
              <li class="list-group-item">
                <b>Semester : </b>{{ $user->profile->semester ?? 'empty' }}
              </li>
              <li class="list-group-item">
                <b>Program Studi : </b>{{ $user->profile->program_studi ?? 'empty' }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
