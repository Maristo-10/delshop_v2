@include('navs')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Tidak Berhasil',
            text: '{{ session('error') }}', // Ambil pesan error dari session
        });
    </script>
@endif
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}', // Ambil pesan error dari session
        });
    </script>
@endif
<div class="container">
    <div class="row pt-3 pb-3">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center ">
                    @foreach ($pengguna as $data)
                        <img src="/user-images/{{ $data->gambar_pengguna }}" alt="Profile" class="rounded-circle"
                            style="width: 250px; border: solid 5px">
                        <h2>{{ $data->name }}</h2>
                        <h3>{{ $data->pekerjaan }}</h3>
                        <div class="social-links mt-2">
                            <a href="{{ $data->twitter }}" class="text-dark twitter"><i class="bi bi-twitter"></i></a>
                            <a href="{{ $data->facebook }}" class="text-dark facebook"><i
                                    class="bi bi-facebook"></i></a>
                            <a href="{{ $data->instagram }}" class="text-dark instagram"><i
                                    class="bi bi-instagram"></i></a>
                            <a href="{{ $data->linkedin }}" class="text-dark linkedin"><i
                                    class="bi bi-linkedin"></i></a>
                        </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body pt-3">
                    <div class="tab-content pt-2">
                        <div class=" profile-edit pt-3" id="profile-edit">
                            @if (Auth::user()->role_pengguna == 'Admin')
                                <form action="/aprofile/update" method="POST" enctype="multipart/form-data"
                                    name="form_prof" id="form_prof">
                                @else
                                    <form action="/profile/update" method="POST" enctype="multipart/form-data"
                                        name="form_prof" id="form_prof">
                            @endif
                            @csrf
                            <div class="row mb-3">
                                <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                <div class="col-md-8 col-lg-9">
                                    <img class="rounded-circle" id="uploadPreview"
                                        src="/user-images/{{ $data->gambar_pengguna }}" alt="Profile"
                                        style="height: 200px;width:200px; border: solid 5px">
                                    <div class="row pt-2 col-4">
                                        <div class="col-7 pt-1" style="text-align: right">
                                            <input class="form-control @error('image') is invalid @enderror"
                                                type="file" id="gambar_pengguna" name="gambar_pengguna"
                                                onchange="PreviewImage();" style="display:none">
                                            <label for="gambar_pengguna" class="btn btn-primary btn-xs"
                                                title="Upload new profile image"><i
                                                    class="fa-solid fa-upload"></i>Unggah Foto</label>
                                        </div>
                                        {{-- <div class="col-5">
                                        <a href="#" class="btn btn-danger btn-sm"
                                            title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                    </div> --}}
                                        <script type="text/javascript">
                                            var PreviewImage = function(event) {
                                                var oFReader = new FileReader();
                                                oFReader.readAsDataURL(document.getElementById("gambar_pengguna").files[0]);
                                                oFReader.onload = function(oFREvent) {
                                                    document.getElementById("uploadPreview").src = oFREvent.target.result;
                                                };
                                            };
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama
                                    Pengguna</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="name" type="text" class="form-control" id="name"
                                        value="{{ $data->name }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="email" type="email" class="form-control" id="Email"
                                        value="{{ $data->email }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jenis_kelamin" class="col-md-4 col-lg-3 col-form-label">Jenis
                                    Kelamin</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="jenis_kelamin" type="text" class="form-control" id="jenis_kelamin"
                                        value="{{ $data->jenis_kelamin }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="pekerjaan" class="col-md-4 col-lg-3 col-form-label">Pekerjaan</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="pekerjaan" type="text" class="form-control" id="pekerjaan"
                                        value="{{ $data->pekerjaan }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="alamat" type="text" class="form-control" id="alamat"
                                        value="{{ $data->alamat }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="no_telp" class="col-md-4 col-lg-3 col-form-label">No. Telp</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="no_telp" type="text" class="form-control" id="no_telp"
                                        value="{{ $data->no_telp }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tentang" class="col-md-4 col-lg-3 col-form-label">Tentang</label>
                                <div class="col-md-8 col-lg-9">
                                    <textarea name="tentang" class="form-control" id="tentang" style="height: 100px">{{ $data->tentang }}</textarea>
                                </div>
                            </div>
                            <p class="text-dark" style="font-weight:bold">Ubah Password</p>
                            <div class="row mb-3">
                                <label for="password_old" class="col-md-4 col-lg-3 col-form-label">Password
                                    Lama</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="password_old" type="password" class="form-control"
                                        id="password_old">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password_new" class="col-md-4 col-lg-3 col-form-label">Password
                                    Baru</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="password_new" type="password" class="form-control"
                                        id="password_new">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="kpassword_new" class="col-md-4 col-lg-3 col-form-label">Konfirmasi
                                    Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="kpassword_new" type="password" class="form-control"
                                        id="kpassword_new">
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                            <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter
                                Profile</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="twitter" type="text" class="form-control" id="Twitter"
                                    value="{{ $data->twitter }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook
                                Profile</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="facebook" type="text" class="form-control" id="Facebook"
                                    value="{{ $data->facebook }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="instagram" class="col-md-4 col-lg-3 col-form-label">Instagram
                                Profile</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="instagram" type="text" class="form-control" id="instagram"
                                    value="{{ $data->instagram }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin
                                Profile</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="linkedin" type="text" class="form-control" id="Linkedin"
                                    value="{{ $data->linkedin }}">
                            </div>
                        </div> --}}
                            <div class="text-center">
                                <button type="button" onclick="ubahConfirmation()" class="btn btn-primary">Simpan
                                    Perubahan</button>
                                <script>
                                    function ubahConfirmation() {
                                        Swal.fire({
                                            title: 'Konfirmasi',
                                            text: 'Apakah Anda yakin ingin mengubah data ini?',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonText: 'Ya',
                                            cancelButtonText: 'Batal',
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                document.getElementById('form_prof').submit();
                                            }
                                        });
                                    }
                                </script>
                            </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
