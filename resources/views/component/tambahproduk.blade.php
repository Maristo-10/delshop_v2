<form class="mb-5" action="/proses/tambah/produk" id="form-tambahproduk" method="post" enctype="multipart/form-data">
    @csrf
    <p class="text-muted">Lengkapi form berikut untuk menambahkan data produk!</p>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" id="nama_produk" name="nama_produk" class="form-control" placeholder="">
                    </div>
                    <div class="form-group mb-3">
                        <label for="harga_jual">Harga Jual</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="number" class="form-control" aria-label="" id="harga_jual" name="harga_jual">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="harga_modal">Modal Produk</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="number" class="form-control" aria-label="" id="harga_modal" name="harga_modal">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="jumlah_produk">Jumlah Produk</label>
                        <input type="number" id="jumlah_produk" name="jumlah_produk" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="kategori_produk">Kategori Produk</label>
                        <select class="form-control" id="kategori_produk" name="kategori_produk">
                            <option disabled selected>Pilih Kategori Produk</option>
                            <option value="Pakaian">Pakaian</option>
                            <option value="Sepatu">Sepatu</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="kategori_pembeli">Kategori Pembeli</label>
                        <select class="form-control" id="kategori_pembeli" name="kategori_pembeli">
                            <option disabled selected>Pilih Kategori Pembeli</option>
                            <option value="Admin">1</option>
                            <option value="Dosen/Staff">2</option>
                            <option value="Mahasiswa">3</option>
                            <option value="Pegawai">4</option>
                            <option value="Publik">5</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="gambar_produk">Gambar Produk</label>
                        <div class="custom-file">
                            <input type="file" class="form-control-file" id="gambar_produk" name="gambar_produk">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"></textarea>
                    </div>
                </div> <!-- /.card-body -->
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
                                document.getElementById('form-tambahproduk').submit();
                            }
                        });
                    }
                </script>
                <button class="btn btn-secondary col-md-1 ml-3 mr-3" type="reset">Reset</button>
            </div>
        </div>
    </div>
</form>

