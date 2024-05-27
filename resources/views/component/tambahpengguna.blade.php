<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@php
    $current = Illuminate\Support\Facades\Route::currentRouteName();
@endphp
@if ($current == 'admin.tambahpengguna')
    <form class="mb-5" action="/proses/tambah/pengguna" id="form-tambahpengguna" method="post"
        enctype="multipart/form-data">
@endif
@if ($current == 'admin.importpengguna')
    <form class="mb-5" action="/proses/import/pengguna" id="form-tambahpengguna" method="post"
        enctype="multipart/form-data">
@endif
@csrf
<p class="text-muted">Lengkapi form berikut untuk menambahkan data pengguna!</p>
<div class="row">

    @if ($current == 'admin.tambahpengguna')
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="nama_produk">Nama Pengguna</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="">
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama_produk">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="role_pengguna">Kategori Pengguna</label>
                        <select class="form-control" id="role_pengguna" name="role_pengguna">
                            <option disabled selected>Pilih Kategori Pengguna</option>
                            @foreach ($role as $kp)
                                <option value="{{ $kp->role }}">{{ $kp->role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($current == 'admin.importpengguna')
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="nama_produk">Masukkan File Excel</label>
                        <input type="file" id="file_excel" name="file_excel" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
<div class="col-md-12 pt-4 pb-5">
    <div class="row" style="justify-content: right">
        <button class="btn btn-success col-md-1" type="button" onclick="tambahConfirmation()">Tambah</button>
        <script>
            function tambahConfirmation() {
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin menambahkan data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-tambahpengguna').submit();
                    }
                });
            }
        </script>
        <button class="btn btn-secondary col-md-1 ml-3 mr-3" type="reset">Reset</button>
    </div>
</div>
</form>
