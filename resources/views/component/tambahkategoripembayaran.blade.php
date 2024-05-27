<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<form class="mb-5" action="/proses/tambah/kategori/pembayaran" id="form-tambahkategoripembayaran" method="post" enctype="multipart/form-data">
    @csrf
    <p class="text-muted">Lengkapi form berikut untuk menambahkan data kategori pembayaran!</p>
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="nama_produk">Nama Kategori Pembayaran</label>
                    <input type="text" id="kategori_pembayaran" name="kategori_pembayaran" class="form-control"
                        placeholder="">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 pt-4 pb-5">
        <div class="row" style="justify-content: right">
            <button class="btn btn-success col-md-2" type="button" onclick="tambahConfirmation()">Tambah</button>
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
                            document.getElementById('form-tambahkategoripembayaran').submit();
                        }
                    });
                }
            </script>
            <button class="btn btn-secondary col-md-2 ml-3 mr-3" type="reset">Reset</button>
        </div>
    </div>
</form>
