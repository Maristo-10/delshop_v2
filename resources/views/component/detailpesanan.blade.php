@include('navs')
<div class="site-section">
    <div class="container pl-5" style="max-width: 1300px">
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="col-lg-12 pb-3">
                    <a href="/riwayat-pesanan" class="btn btn-secondary" style="border:solid 2px; border-color: black"><i
                            class="fa-solid fa-angle-left"></i> Kembali ke Pesanan Saya</a>
                    @if ($pesanan->status == 'Menunggu')
                        <input type="hidden" name="kodePes" id="kodePes" value="{{ $pesanan->kode }}">
                        <button data-toggle="modal" data-target=".cancelPesanan" class="btn btn-danger" style="float: right">Batalkan
                            Pesanan</button>
                        <div class="modal fade cancelPesanan" id="defaultModal" tabindex="-1" role="dialog"
                            aria-labelledby="defaultModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered" role="document" style="z-index: 1000">
                                <div class="modal-content">
                                    <form action="/pembatalan/pesanan/{{ $pesanan->kode }}" method="POST"
                                        name="form-cancel" id="form-cancel">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="defaultModalLabel">Konfirmasi
                                                Pembatalan
                                                Pesanan
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label for="alasan">Alasan Pembatalan</label>
                                                    <input type="text" id="alasan" name="alasan"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn mb-2 btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="button" onclick="canPes()"
                                                class="btn mb-2 btn-danger">Batalkan Pesanan</button>
                                        </div>
                                        <script>
                                            function canPes() {
                                                Swal.fire({
                                                    title: 'Konfirmasi',
                                                    text: 'Apakah Anda yakin ingin membatalkan pesanan ini?',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Ya',
                                                    cancelButtonText: 'Batal',
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        document.getElementById('form-cancel').submit();
                                                    }
                                                });
                                            }
                                        </script>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <script>
                            function batalkanPesanan() {
                                var kode = $('#kodePes').val();
                                Swal.fire({
                                    title: 'Konfirmasi',
                                    text: 'Apakah Anda yakin ingin membatalkan pesanan ini?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Ya',
                                    cancelButtonText: 'Batal',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = '/batalkan/pesanan/' + kode;
                                    }
                                });
                            }
                        </script>
                    @endif
                </div>

                @if ($pesanan->status == 'Menunggu')
                    <div class="col-lg-12 p-2 bg-warning" style="border-radius:7px">
                @endif
                @if ($pesanan->status == 'Diproses')
                    <div class="col-lg-12 p-2 bg-info" style="border-radius:7px">
                @endif
                <div class="row">
                    <div class="col-lg-1" style="align-self: center;text-align-last:center">
                        @if ($pesanan->status == 'Menunggu')
                            <i class="fa-solid fa-stopwatch" style="font-size: xxx-large;color:black"></i>
                        @endif
                        @if ($pesanan->status == 'Diproses')
                            <i class="fa-solid fa-spinner" style="font-size: xxx-large;color:white"></i>
                        @endif

                    </div>
                    <div class="col-lg-9">
                        <div class="col-12">
                            @if ($pesanan->status == 'Menunggu')
                                <h5 class="text-light">Menunggu Pesanan Dikonfirmasi</h5>
                            @endif
                            @if ($pesanan->status == 'Diproses')
                                <h5 class="text-light">Pesanan Sedang Diproses</h5>
                            @endif
                        </div>
                        <div class="col-lg-12">
                            @if ($pesanan->status == 'Menunggu')
                                <h6 class="text-light">Pesanan dalam antrian konfirmasi, mohon menunggu. </h6>
                                <h6 class="text-light">Terimakasih!</h6>
                            @endif
                            @if ($pesanan->status == 'Diproses')
                                <h6 class="text-light">Pesanan sedang diproses oleh Petugas, mohon menunggu. </h6>
                                <h6 class="text-light">Terimakasih!</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-12 pt-3">
            <div class="row">
                <div class="col-lg-6">
                    <div class="col-lg-12 p-2" style="border: solid 2px; border-radius:5px">
                        <div class="p-2">
                            <h5 class="text-dark">ID Pesanan</h5>
                            <h6 class="text-dark">{{ $pesanan->kode }}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="col-lg-12 p-2" style="border: solid 2px; border-radius:5px">
                        <div class="p-2">
                            <h5 class="text-dark">Tanggal Pesanan</h5>
                            <h6 class="text-dark">{{ $pesanan->tanggal }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 pt-3">
            <div class="col-lg-12 p-2" style="border: solid 2px; border-radius:5px">
                <div class="p-2">
                    <h5 class="text-dark">Penerima</h5>
                    <h6 class="text-dark">{{ $pesanan->nama_pengambil }}</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-6 pt-3">
            <div class="col-lg-12 p-2" style="border: solid 2px; border-radius:5px">
                <div class="p-2">
                    <h5 class="text-dark">Pemesan</h5>
                    <h6 class="text-dark"><b></b>{{ $pesanan->nama_pengambil }} , +62 812 3456 7890, Mahasiswa</h6>
                </div>
            </div>
        </div>
        @foreach ($detail_pes as $det)
            <div class="col-lg-12 pt-3">
                <div class="col-lg-12 p-2" style="border: solid 2px; border-radius:5px">
                    <div class="row p-3">
                        <div class="col-lg-2" style="text-align: center">
                            <img src="/product-images/{{ $det->gambar_produk }}" alt=""
                                style="max-height: 100px; min-height: 100px; max-width : 150px">
                        </div>
                        <div class="col-lg-6" style="place-self: center">
                            <div class="row">
                                <div class="col-sm-12">
                                    <span class="text-dark" style="font-weight: bold">{{ $det->nama_produk }}</span>
                                </div>
                                <div class="col-sm-12">
                                    <span class="text-dark">Variasi : </span>
                                </div>
                                <div class="col-sm-12">
                                    <span class="text-dark">Jumlah Produk : {{ $det->jumlah }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-dark"
                            style="text-align-last: right; font-weight:bold; place-self:center">
                            <div class="row pr-4">
                                <div class="col-12">
                                    Subtotal
                                </div>
                                <div class="col-12">
                                    Rp. <?php
                                    echo number_format($det->jumlah_harga, 0, ',', '.');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</div>
