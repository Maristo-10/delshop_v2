<form class="mb-5" action="/proses/ubah/kategori-produk/{{$kategoris->kategori}}" id="form-ubahkategoriproduk" method="post" enctype="multipart/form-data">
    @csrf
    <p class="text-muted">Lengkapi form berikut untuk mengubah data kategori produk!</p>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="nama_produk">Nama Kategori Produk</label>
                        <input type="text" id="kategori" name="kategori" class="form-control" placeholder="" value="{{$kategoris->kategori}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="gambar_produk">Gambar Kategori Produk</label>
                        <div class="custom-file">
                            <input type="file" class="form-control-file" id="gambar_kategori" name="gambar_kategori">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 pt-4 pb-5">
            <div class="row" style="justify-content: right">
                <button class="btn btn-warning col-md-1" type="button" onclick="ubahConfirmation()">Simpan</button>
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
                                document.getElementById('form-ubahkategoriproduk').submit();
                            }
                        });
                    }
                </script>
                <button class="btn btn-secondary col-md-1 ml-3 mr-3" type="reset">Reset</button>
            </div>
        </div>
    </div>
</form>

