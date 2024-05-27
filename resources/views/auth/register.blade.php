@extends('auth')

@section('content')
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-8 d-flex flex-column align-items-center justify-content-center">
                    <div class="card mb-1 mt-1">
                        <div class="card-body">
                            <div class="row mb-1 text-center">
                                <div class="col">
                                    <a href="{{ asset('/') }}"><img src={{ asset('/pembeli/images/logo2.png') }}
                                            alt="" style="width: 130px; "></a>
                                </div>
                            </div>
                            <div class="pt-1 pb-1">
                                <h5 class="card-title text-center pb-0 fs-4">Buat Akun</h5>
                                <p class="text-center small">Mohon Input Data Anda!</p>
                            </div>

                            <form class="row g-3 needs-validation" action="{{ route('register') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-6">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <div class="input-group has-validation">
                                        <span class="bi bi-person input-group-text" id="inputGroupPrepend"></span>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label for="no_telp" class="form-label">No. Telepon</label>
                                    <div class="input-group has-validation">
                                        <span class="bi bi-envelope input-group-text" id="inputGroupPrepend"></span>
                                        <input id="no_telp" type="no_telp"
                                            class="form-control @error('no_telp') is-invalid @enderror" name="no_telp"
                                            value="{{ old('no_telp') }}" required autocomplete="email">

                                        @error('no_telp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group has-validation">
                                        <span class="bi bi-envelope input-group-text" id="inputGroupPrepend"></span>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <div class="input-group has-validation">
                                        <span class="bi bi-envelope input-group-text" id="inputGroupPrepend"></span>
                                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                            <option selected disabled>Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group has-validation">
                                        <span class=" bi bi-lock input-group-text" id="inputGroupPrepend"></span>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label for="password_konfirm" class="form-label">Konfirmasi
                                        Password</label>
                                    <div class="input-group has-validation">
                                        <span class=" bi bi-lock input-group-text" id="inputGroupPrepend"></span>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                        <div class="invalid-feedback">Please enter a password.</div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label for="role_pengguna" class="form-label">Daftar Sebagai</label>
                                    <div class="input-group has-validation">
                                        <span class="bi bi-envelope input-group-text" id="inputGroupPrepend"></span>
                                        <select class="form-control" name="role_pengguna" id="role_pengguna">
                                            <option selected disabled>Pilih Kategori Pengguna</option>
                                            <option value="Publik">Publik</option>
                                            <option value="Mahasiswa">Mahasiswa</option>
                                            <option value="Dosen/Staff">Dosen/Staff</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6" name="bukti" id="bukti" hidden>
                                    <label for="bukti_pengguna" class="form-label">Bukti Kategori Pengguna</label>
                                    <div class="input-group has-validation">
                                        <span class="bi bi-envelope input-group-text" id="inputGroupPrepend"></span>
                                        ` <input type="file" class="form-control" name="bukti_pengguna"
                                            id="bukti_pengguna">
                                    </div>
                                    <small class="text-danger">* Gambar dengan format .jpg dan .png</small><br>
                                    <small class="text-danger">* Hasil screenshoot profile CIS Mahasiswa atau Dosen/Staff</small>
                                </div>

                                <div class=" col-12 mt-4">
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                                <div class=" row col-12 justify-content-center mt-3">
                                    <p>Sudah Punya Akun? <a href="{{ route('login') }}"
                                            class="btn text-secondary">Masuk</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#role_pengguna').on('change', function() {
                    var role = this.value;
                    console.log(role);
                    if(role == "Publik"){
                        $('#bukti').prop('hidden', true);
                    }
                    if(role == "Mahasiswa" || role == "Dosen/Staff"){
                        $('#bukti').prop('hidden', false);
                    }
                });
            });
        </script>
    </section>
@endsection
