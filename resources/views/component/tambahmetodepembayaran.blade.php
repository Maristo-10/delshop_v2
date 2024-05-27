<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<form class="mb-5" action="/proses/tambah/metode/pembayaran" id="form-tambahmetodepembayaran" method="post"
    enctype="multipart/form-data">
    @csrf
    <p class="text-muted">Lengkapi form berikut untuk menambahkan data metode pembayaran!</p>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="kategori_pembeli">Kategori Pembayaran</label>
                        <select class="form-control" id="kategori_layanan" name="kategori_layanan">
                            <option disabled selected>Pilih Kategori Pembeli</option>
                            @foreach ($kapem as $kp)
                                <option value="{{ $kp->id_kapem }}">{{ $kp->kategori_pembayaran }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama_produk">Nama Pemilik</label>
                        <input type="text" id="nama_pemilik" name="nama_pemilik" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="layanan">Nama Layanan</label>
                        <input type="text" id="layanan" name="layanan" class="form-control" placeholder="">
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama_produk">Nomor Pembayaran</label>
                        <input type="text" id="no_layanan" name="no_layanan" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
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
                            document.getElementById('form-tambahmetodepembayaran').submit();
                        }
                    });
                }
            </script>
            <button class="btn btn-secondary col-md-1 ml-3 mr-3" type="reset">Reset</button>
        </div>
    </div>
</form>
