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
                            <input type="number" class="form-control" aria-label="" id="harga_modal"
                                name="harga_modal">
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
                            @foreach ($kategori_produk as $kapro)
                                <option value="{{ $kapro->kategori }}">{{ $kapro->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="kategori_pembeli">Kategori Pembeli</label>
                        <select class="form-control" id="kategori_pembeli" name="kategori_pembeli">
                            <option disabled selected>Pilih Kategori Pembeli</option>
                            <option value="Admin">Admin</option>
                            <option value="Dosen/Staff">Dosen/Staff</option>
                            <option value="Mahasiswa">Mahasiswa</option>
                            <option value="Pegawai">Pegawai</option>
                            <option value="Publik">Publik</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="gambar_produk">Gambar Produk</label>
                        <div class="custom-file" id="field-gambar">
                            <div class="input-group">
                                <input type="file" class="form-control col-md-5" id="gambar_produk"
                                    name="gambar_produk[]" style="border-color:transparent">
                                <button type="button" onclick="tambahGambar()"
                                    class="text-dark btn btn-md btn-success"><i class="fa-solid fa-square-plus fa-lg"
                                        id="tambah-fproduk"></i>Tambah Gambar Produk</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-3" id="tambah-variasi">
            <div class="col-md-12 mb-4">
                <button type="button" class="btn btn-success add-variasi-produk"><i
                        class="fa-solid fa-square-plus fa-xl"></i> Tambah Variasi Produk</button>
            </div>
            <div class="col-md-12">
                <div class="row" id="variasi_produks">

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.add-variasi-produk').click(function() {
            var elements = document.querySelectorAll('#variasi_produk');
            var jlhElement = elements.length + 1;
            console.log(elements);
            var newInput = '<div class="col-md-6 mb-3 hapus-variasi"><div class="card shadow">' +
                '<div class="card-body">' +
                '<div class="form-group mb-3" id="variasi">' +
                '<div style="text-align: -webkit-right">' +
                '<button type="button" class="btn btn-danger remove-variasi-produk" style="background-color: transparent; border-color:transparent"><i class="fa-regular fa-circle-xmark fa-2xl text-danger"></i></button>' +
                '</div>' +
                '<div class="form-group mb-3">' +
                '<label for="nama_produk">Nama Variasi Produk</label>' +
                '<input type="text" id="variasi_produk" name="variasi_produk_' + jlhElement +
                '" class="form-control"' +
                'placeholder="">' +
                '</div>' +
                '<div class="form-group mb-3" name="variasiProduk">' +
                '<label for="nama_produk">Jenis Variasi Produk</label>' +
                '<div class="input-group">' +
                '<input type="hidden" id="idVariasi" name="idVariasi" value="' + jlhElement + '">' +
                '<input type="text" id="jenis_variasi" name="jenis_variasi_' + jlhElement +
                '[]" class="form-control"' +
                'placeholder="">' +
                '<button type="button" class="btn btn btn-primary add-variasi"><i ' +
                'class="fa-solid fa-circle-plus fa-xl text-white"></i></button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div></div>';
            $('#variasi_produks').append(newInput);
        });

        $('#variasi_produks').on('click', '.add-variasi', function() {
            var idVariasi = $(this).closest('#variasi').find('#idVariasi').val();
            var newInput =
                '<div class="input-group mt-3 tambahan-variasi"><input type="text" id="jenis_variasi" name="jenis_variasi_' +
                idVariasi +
                '[]" class="form-control" placeholder=""><button type="button" class="btn btn btn-danger remove-variasi"><i class="fa-solid fa-trash fa-xl text-white"></i></button></div>';
            $(this).closest('#variasi').append(newInput);
        });

        $('#variasi_produks').on('click', '.remove-variasi-produk', function() {
            $(this).closest('.hapus-variasi').remove();
        });

        $('#variasi_produks').on('click', '.remove-variasi', function() {
            $(this).closest('.tambahan-variasi').remove();
        });
    });

    function tambahGambar() {
        var newInput =
            '<div class="input-group mb-3 mt-2" id="fgambar">' +
            '<input type="file" class="form-control col-md-5" id="gambar_produk" name="gambar_produk[]" style="border-color:transparent">' +
            '<button type="button" id="hapusgambar" class="text-white btn btn-md btn-danger">' +
            '<i class="fa-solid fa-trash fa-lg"></i></button>'
        '</div>';
        $('#field-gambar').append(newInput);
    };

    $('#field-gambar').on('click', '#hapusgambar', function() {
            $(this).closest('#fgambar').remove();
        });
</script>
