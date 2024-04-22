<form class="mb-5" action="/proses/ubah/produk/{{$produk->id_produk}}" id="form-ubahproduk" method="post" enctype="multipart/form-data">
    @csrf
    <p class="text-muted">Lengkapi form berikut untuk mengubah data produk!</p>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" id="nama_produk" name="nama_produk" class="form-control" placeholder="" value="{{ $produk->nama_produk}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="harga_jual">Harga Jual</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="number" class="form-control" aria-label="" id="harga_jual" name="harga_jual" value="{{$produk->harga}}">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="harga_modal">Modal Produk</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="number" class="form-control" aria-label="" id="harga_modal" name="harga_modal" value="{{$produk->modal}}">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="jumlah_produk">Jumlah Produk</label>
                        <input type="number" id="jumlah_produk" name="jumlah_produk" class="form-control" value="{{$produk->jumlah_produk}}">
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
                            <option disabled selected>{{$produk->kategori_produk}}</option>
                            <option value="Baju">Baju</option>
                            <option value="Baju">Baju</option>
                            <option value="Baju">Baju</option>
                            <option value="Pin">Pin</option>
                            <option value="Pin">Pin</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="kategori_pembeli">Kategori Pembeli</label>
                        <select class="form-control" id="kategori_pembeli" name="kategori_pembeli">
                            <option disabled selected>{{ $produk->role_pembeli}}</option>
                            <option value="Admin">Admin</option>
                            <option value="Dosen/Staff">Dosen/Staff</option>
                            <option value="Mahasiswa">Mahasiswa</option>
                            <option value="Publik">Publik</option>
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
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4">{{$produk->deskripsi}}</textarea>
                    </div>
                </div> <!-- /.card-body -->
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
                                document.getElementById('form-ubahproduk').submit();
                            }
                        });
                    }
                </script>
                <button class="btn btn-secondary col-md-1 ml-3 mr-3" type="reset">Reset</button>
            </div>
        </div>
    </div>
</form>

