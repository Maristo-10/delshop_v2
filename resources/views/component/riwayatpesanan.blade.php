@include('navs')
@php
    use App\Models\DetailPesanan;
@endphp
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@if (session('error'))
    <script>
        // Tampilkan pesan error dalam pop-up
        Swal.fire({
            icon: 'error',
            title: 'Tidak Berhasil',
            text: '{{ session('error') }}', // Ambil pesan error dari session
        });
    </script>
@endif
@if (session('success'))
    <script>
        // Tampilkan pesan error dalam pop-up
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}', // Ambil pesan error dari session
        });
    </script>
@endif
<style>
    .nav-pills .nav-link.active {
        background-color: #00337C !important;
        /* Warna latar belakang */
        color: white;
        /* Warna teks */
    }

    /* Merubah warna teks pada selector yang tidak aktif */
    .nav-pills .nav-link {
        color: black;
        /* Warna teks default */
    }
</style>

<div class="site-section">
    <div class="container">
        <!-- Navs -->
        <ul class="nav nav-pills nav-fill p-1" role="tablist" style="border: solid 2px; border-radius: 10px">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#semua">Semua</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menunggu">Menunggu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#diproses">Diproses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#diambil">Dapat diambil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#selesai">Selesai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#dibatalkan">Dibatalkan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#ditolak">Ditolak</a>
            </li>
        </ul>
        <!-- Konten untuk setiap tab -->
        <div class="tab-content pt-3">
            <div id="semua" class="tab-pane fade show active">
                @foreach ($pesanan as $pes)
                    <div class="container pb-2">
                        <div class="row" style="border: solid 1px; border-radius: 5px">
                            <div class="col-lg-10 p-4">
                                <div class="row">
                                    <div class="col-lg-2" style="place-self: center">
                                        <img src="pembeli/images/baju.jpg" alt="" class="w-100">
                                    </div>
                                    @if ($pes->status == 'Menunggu')
                                        <div class="col-lg-4" style="place-self: center">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <span class="pr-3"
                                                        style="color: #00337C;font-weight:bold">{{ $pes->kode }}</span>
                                                    {{ $pes->tanggal }}
                                                </div>
                                                @php
                                                    $detail_pes = DetailPesanan::join(
                                                        'produk',
                                                        'produk.id_produk',
                                                        '=',
                                                        'pesanandetails.produk_id',
                                                    )
                                                        ->where('pesanan_id', $pes->id)
                                                        ->first();
                                                    $detail = DetailPesanan::where('pesanan_id', $pes->id)->get();
                                                    $j = 0;
                                                    $h = 0;
                                                    foreach ($detail as $data) {
                                                        $j += $data->jumlah;
                                                        $h += $data->jumlah_harga;
                                                    }
                                                    $jumlah_detail = count($detail);
                                                    $sisa = $jumlah_detail - 1;
                                                @endphp
                                                <div class="col-sm-12">
                                                    <span class="text-dark pr-2">{{ $detail_pes->nama_produk }}</span>
                                                    @if ($sisa != 0)
                                                        <small><a href="/detail-pesanan/{{ $pes->kode }}"
                                                                class="p-1 text-white bg-secondary"
                                                                style="border-radius: 3px">+{{ $sisa }}
                                                                lainnya</a></small>
                                                    @endif
                                                </div>
                                                <div class="col-sm-12">
                                                    <span class="text-dark">Jumlah Produk : {{ $j }}</span>
                                                </div>
                                                <div class="col-sm-12">
                                                    <span class="text-dark">Nama Pemesan : {{ $pes->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2" style="place-self: center; text-align:center">
                                            <input type="hidden" name="kodePes" id="kodePes" value="{{$pes->kode}}">
                                            <button onclick="batalkanPesanan()" class="btn btn-danger">Batalkan Pesanan</button>
                                        </div>
                                        <script>
                                            function batalkanPesanan() {
                                                var kode =  $('#kodePes').val();
                                                Swal.fire({
                                                    title: 'Konfirmasi',
                                                    text: 'Apakah Anda yakin ingin membatalkan pesanan ini?',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Ya',
                                                    cancelButtonText: 'Batal',
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        window.location.href = '/batalkan/pesanan/'+ kode;
                                                    }
                                                });
                                            }
                                        </script>
                                    @else
                                        <div class="col-lg-6" style="place-self: center">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <span class="pr-3"
                                                        style="color: #00337C;font-weight:bold">{{ $pes->kode }}</span>
                                                    {{ $pes->tanggal }}
                                                </div>
                                                @php
                                                    $detail_pes = DetailPesanan::join(
                                                        'produk',
                                                        'produk.id_produk',
                                                        '=',
                                                        'pesanandetails.produk_id',
                                                    )
                                                        ->where('pesanan_id', $pes->id)
                                                        ->first();
                                                    $detail = DetailPesanan::where('pesanan_id', $pes->id)->get();
                                                    $j = 0;
                                                    $h = 0;
                                                    foreach ($detail as $data) {
                                                        $j += $data->jumlah;
                                                        $h += $data->jumlah_harga;
                                                    }
                                                    $jumlah_detail = count($detail);
                                                    $sisa = $jumlah_detail - 1;
                                                @endphp
                                                <div class="col-sm-12">
                                                    <span class="text-dark pr-2">{{ $detail_pes->nama_produk }}</span>
                                                    @if ($sisa != 0)
                                                        <small><a href="/detail-pesanan/{{ $pes->kode }}"
                                                                class="p-1 text-white bg-secondary"
                                                                style="border-radius: 3px">+{{ $sisa }}
                                                                lainnya</a></small>
                                                    @endif
                                                </div>
                                                <div class="col-sm-12">
                                                    <span class="text-dark">Jumlah Produk : {{ $j }}</span>
                                                </div>
                                                <div class="col-sm-12">
                                                    <span class="text-dark">Nama Pemesan : {{ $pes->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-lg-4" style="place-self: center">
                                        <div class="row" style="place-content: center;text-align-last:center">
                                            <div class="col-lg-12 pt-1 pb-1 pl-3 pr-3 bg-warning text-dark"
                                                style="border-radius: 5px; max-width:max-content;font-weight:bold">
                                                {{ $pes->status }}
                                            </div>
                                            <div class="col-lg-12 pt-5">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5 class="text-dark">Total Belanja</h5>
                                                    </div>
                                                    <div class="col-12">
                                                        <span class="text-dark" style="font-weight: bold">Rp.
                                                            <?php
                                                            echo number_format($h, 0, ',', '.');
                                                            ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 -4"
                                style="background-color: #00337C !important; border-bottom-right-radius:5px;border-top-right-radius:5px; display: flex; justify-content: center; align-items: center;">
                                <a href="/detail-pesanan/{{ $pes->kode }}"
                                    style="color: #fff;display: flex; justify-content: center; align-items: center;">
                                    <span class="text-white">Lihat Detail Pesanan</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="menunggu" class="tab-pane fade">
                <div class="row" style="border: solid 1px; border-radius: 5px">
                    <div class="col-lg-10 p-4">
                        <div class="row">
                            <div class="col-lg-2" style="place-self: center">
                                <img src="pembeli/images/baju.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-lg-6" style="place-self: center">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <span class="pr-3"
                                            style="color: #00337C;font-weight:bold">DEL-ORD-I24-003</span>
                                        Kamis, 28 Maret 2024
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Kaos Putih Del</span>
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Variasi : </span>
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Jumlah Produk : 1</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4" style="place-self: center">
                                <div class="row" style="place-content: center;text-align-last:center">
                                    <div class="col-lg-12 pt-1 pb-1 pl-3 pr-3 bg-warning text-dark"
                                        style="border-radius: 5px; max-width:max-content;font-weight:bold">Menunggu
                                    </div>
                                    <div class="col-lg-12 pt-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="text-dark">Total Belanja</h5>
                                            </div>
                                            <div class="col-12">
                                                <span class="text-dark" style="font-weight: bold">Rp. 100.000</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 -4"
                        style="background-color: #00337C !important; border-bottom-right-radius:5px;border-top-right-radius:5px; display: flex; justify-content: center; align-items: center;">
                        <a href="/detail-pesanan"
                            style="color: #fff;display: flex; justify-content: center; align-items: center;">
                            <span class="text-white">Lihat Detail Pesanan</span>
                        </a>
                    </div>

                </div>
            </div>
            <div id="diproses" class="tab-pane fade">
                <div class="row" style="border: solid 1px; border-radius: 5px">
                    <div class="col-lg-10 p-4">
                        <div class="row">
                            <div class="col-lg-2" style="place-self: center">
                                <img src="pembeli/images/baju.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-lg-6" style="place-self: center">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <span class="pr-3"
                                            style="color: #00337C;font-weight:bold">DEL-ORD-I24-003</span>
                                        Kamis, 28 Maret 2024
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Kaos Putih Del</span>
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Variasi : </span>
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Jumlah Produk : 1</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4" style="place-self: center">
                                <div class="row" style="place-content: center;text-align-last:center">
                                    <div class="col-lg-12 pt-1 pb-1 pl-3 pr-3 bg-warning text-dark"
                                        style="border-radius: 5px; max-width:max-content;font-weight:bold">Menunggu
                                    </div>
                                    <div class="col-lg-12 pt-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="text-dark">Total Belanja</h5>
                                            </div>
                                            <div class="col-12">
                                                <span class="text-dark" style="font-weight: bold">Rp. 100.000</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 -4"
                        style="background-color: #00337C !important; border-bottom-right-radius:5px;border-top-right-radius:5px; display: flex; justify-content: center; align-items: center;">
                        <a href="/detail-pesanan"
                            style="color: #fff;display: flex; justify-content: center; align-items: center;">
                            <span class="text-white">Lihat Detail Pesanan</span>
                        </a>
                    </div>

                </div>
            </div>
            <div id="diambil" class="tab-pane fade">
                <div class="row" style="border: solid 1px; border-radius: 5px">
                    <div class="col-lg-10 p-4">
                        <div class="row">
                            <div class="col-lg-2" style="place-self: center">
                                <img src="pembeli/images/baju.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-lg-6" style="place-self: center">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <span class="pr-3"
                                            style="color: #00337C;font-weight:bold">DEL-ORD-I24-003</span>
                                        Kamis, 28 Maret 2024
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Kaos Putih Del</span>
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Variasi : </span>
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Jumlah Produk : 1</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4" style="place-self: center">
                                <div class="row" style="place-content: center;text-align-last:center">
                                    <div class="col-lg-12 pt-1 pb-1 pl-3 pr-3 bg-warning text-dark"
                                        style="border-radius: 5px; max-width:max-content;font-weight:bold">Menunggu
                                    </div>
                                    <div class="col-lg-12 pt-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="text-dark">Total Belanja</h5>
                                            </div>
                                            <div class="col-12">
                                                <span class="text-dark" style="font-weight: bold">Rp. 100.000</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 -4"
                        style="background-color: #00337C !important; border-bottom-right-radius:5px;border-top-right-radius:5px; display: flex; justify-content: center; align-items: center;">
                        <a href="detail-pesanan"
                            style="color: #fff;display: flex; justify-content: center; align-items: center;">
                            <span class="text-white">Lihat Detail Pesanan</span>
                        </a>
                    </div>

                </div>
            </div>
            <div id="selesai" class="tab-pane fade">
                <div class="row" style="border: solid 1px; border-radius: 5px">
                    <div class="col-lg-10 p-4">
                        <div class="row">
                            <div class="col-lg-2" style="place-self: center">
                                <img src="pembeli/images/baju.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-lg-6" style="place-self: center">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <span class="pr-3"
                                            style="color: #00337C;font-weight:bold">DEL-ORD-I24-003</span>
                                        Kamis, 28 Maret 2024
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Kaos Putih Del</span>
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Variasi : </span>
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Jumlah Produk : 1</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4" style="place-self: center">
                                <div class="row" style="place-content: center;text-align-last:center">
                                    <div class="col-lg-12 pt-1 pb-1 pl-3 pr-3 bg-warning text-dark"
                                        style="border-radius: 5px; max-width:max-content;font-weight:bold">Menunggu
                                    </div>
                                    <div class="col-lg-12 pt-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="text-dark">Total Belanja</h5>
                                            </div>
                                            <div class="col-12">
                                                <span class="text-dark" style="font-weight: bold">Rp. 100.000</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 -4"
                        style="background-color: #00337C !important; border-bottom-right-radius:5px;border-top-right-radius:5px; display: flex; justify-content: center; align-items: center;">
                        <a href="/detail-pesanan"
                            style="color: #fff;display: flex; justify-content: center; align-items: center;">
                            <span class="text-white">Lihat Detail Pesanan</span>
                        </a>
                    </div>

                </div>
            </div>
            <div id="dibatalkan" class="tab-pane fade">
                <div class="row" style="border: solid 1px; border-radius: 5px">
                    <div class="col-lg-10 p-4">
                        <div class="row">
                            <div class="col-lg-2" style="place-self: center">
                                <img src="pembeli/images/baju.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-lg-6" style="place-self: center">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <span class="pr-3"
                                            style="color: #00337C;font-weight:bold">DEL-ORD-I24-003</span>
                                        Kamis, 28 Maret 2024
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Kaos Putih Del</span>
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Variasi : </span>
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Jumlah Produk : 1</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4" style="place-self: center">
                                <div class="row" style="place-content: center;text-align-last:center">
                                    <div class="col-lg-12 pt-1 pb-1 pl-3 pr-3 bg-warning text-dark"
                                        style="border-radius: 5px; max-width:max-content;font-weight:bold">Menunggu
                                    </div>
                                    <div class="col-lg-12 pt-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="text-dark">Total Belanja</h5>
                                            </div>
                                            <div class="col-12">
                                                <span class="text-dark" style="font-weight: bold">Rp. 100.000</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 -4"
                        style="background-color: #00337C !important; border-bottom-right-radius:5px;border-top-right-radius:5px; display: flex; justify-content: center; align-items: center;">
                        <a href="/detail-pesanan"
                            style="color: #fff;display: flex; justify-content: center; align-items: center;">
                            <span class="text-white">Lihat Detail Pesanan</span>
                        </a>
                    </div>

                </div>
            </div>
            <div id="ditolak" class="tab-pane fade">
                <div class="row" style="border: solid 1px; border-radius: 5px">
                    <div class="col-lg-10 p-4">
                        <div class="row">
                            <div class="col-lg-2" style="place-self: center">
                                <img src="pembeli/images/baju.jpg" alt="" class="w-100">
                            </div>
                            <div class="col-lg-6" style="place-self: center">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <span class="pr-3"
                                            style="color: #00337C;font-weight:bold">DEL-ORD-I24-003</span>
                                        Kamis, 28 Maret 2024
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Kaos Putih Del</span>
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Variasi : </span>
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Jumlah Produk : 1</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4" style="place-self: center">
                                <div class="row" style="place-content: center;text-align-last:center">
                                    <div class="col-lg-12 pt-1 pb-1 pl-3 pr-3 bg-warning text-dark"
                                        style="border-radius: 5px; max-width:max-content;font-weight:bold">Menunggu
                                    </div>
                                    <div class="col-lg-12 pt-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="text-dark">Total Belanja</h5>
                                            </div>
                                            <div class="col-12">
                                                <span class="text-dark" style="font-weight: bold">Rp. 100.000</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 -4"
                        style="background-color: #00337C !important; border-bottom-right-radius:5px;border-top-right-radius:5px; display: flex; justify-content: center; align-items: center;">
                        <a href="/detail-pesanan"
                            style="color: #fff;display: flex; justify-content: center; align-items: center;">
                            <span class="text-white">Lihat Detail Pesanan</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
