<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<form class="mb-5" action="/proses/ubah/kategori/pembayaran/{{$kapem->id_kapem}}" id="form-ubahkategoripembayaran" method="post" enctype="multipart/form-data">
    @csrf
    <p class="text-muted">Lengkapi form berikut untuk mengubah data kategori pembayaran!</p>
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="kategori_pembayaran">Nama Kategori Pembayaran</label>
                    <input type="text" id="kategori_pembayaran" name="kategori_pembayaran" class="form-control"
                        placeholder="" value="{{$kapem->kategori_pembayaran}}">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 pt-4 pb-5">
        <div class="row" style="justify-content: right">
            <button class="btn btn-warning col-md-2" type="button" onclick="ubahConfirmation()">Ubah</button>
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
                            document.getElementById('form-ubahkategoripembayaran').submit();
                        }
                    });
                }
            </script>
            <button class="btn btn-secondary col-md-2 ml-3 mr-3" type="reset">Reset</button>
        </div>
    </div>
</form>
