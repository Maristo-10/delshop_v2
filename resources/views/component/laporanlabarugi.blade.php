<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.css" />
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
<div class="row my-4">
    <div class="col md-12">
        <form class="" action="/laporan/labarugi" id="form-caritanggal" method="get" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group mb-3 col-md-3">
                                    <label for="nama_produk">Tanggal Awal</label>
                                    <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control"
                                        placeholder="">
                                </div>
                                <div class="form-group mb-3 col-md-3">
                                    <label for="nama_produk">Tanggal Akhir</label>
                                    <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control"
                                        placeholder="">
                                </div>
                                <div class="col-md-3 mt-1">
                                    <button class="btn btn-info mt-4"><i
                                            class="fa-solid fa-magnifying-glass pr-1"></i>Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Small table -->
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                @if ($tgl_awal != null && $tgl_akhir != null)
                    <div class="col-md-12 mt-1" style="text-align: right">
                        <form class="" action="/export/laporan/labarugi" id="form-exportlaporanlabarugi"
                            method="get" enctype="multipart/form-data">
                            <input type="hidden" name="awal" id="awal" value="{{ $tgl_awal }}">
                            <input type="hidden" name="akhir" id="akhir" value="{{ $tgl_akhir }}">
                            <button type="submit" class="btn btn-success mb-4"><i
                                    class="fa-solid fa-file-excel pr-1"></i>Export
                                Excel</button>
                        </form>
                    </div>
                @endif
                <!-- table -->
                <table class="table datatables" id="dataTable-1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga Beli/satuan</th>
                            <th>Harga Jual/satuan</th>
                            <th>Jumlah Terjual</th>
                            <th>Total Harga Beli</th>
                            <th>Total Harga Jual</th>
                        </tr>
                    </thead>
                    @if ($tgl_awal != null && $tgl_akhir != null)
                        <tbody>
                            @php
                                $no = 1;
                                $totalterjual = 0;
                                $totalbeli = 0;
                                $totaljual = 0;
                            @endphp
                            @foreach ($penjualan as $penj)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $penj->nama_produk }}</td>
                                    <td style="text-align: right">Rp. <?php
                                    $angka = $penj->modal;
                                    echo number_format($angka, 0, ',', '.');
                                    ?></td>
                                    <td style="text-align: right">Rp. <?php
                                    $angka = $penj->harga;
                                    echo number_format($angka, 0, ',', '.');
                                    ?></td>
                                    @php
                                        $terjual = App\Models\DetailPesanan::join('pesanans', 'pesanans.id','=', 'pesanandetails.pesanan_id')->where(
                                            'pesanandetails.produk_id',
                                            $penj->id_produk,
                                        )->where('pesanans.status', 'Selesai')->get();
                                        $jlhterjual = 0;
                                        foreach ($terjual as $terj) {
                                            $jlhterjual += $terj->jumlah;
                                        }
                                        $totalterjual += $jlhterjual;
                                        $totalbeli += $jlhterjual * $penj->modal;
                                        $totaljual += $jlhterjual * $penj->harga;
                                    @endphp
                                    <td style="text-align: center">{{ $jlhterjual }}</td>
                                    <td style="text-align: right">Rp. <?php
                                    $angka = $jlhterjual * $penj->modal;
                                    echo number_format($angka, 0, ',', '.');
                                    ?></td>
                                    <td style="text-align: right">Rp. <?php
                                    $angka = $jlhterjual * $penj->harga;
                                    echo number_format($angka, 0, ',', '.');
                                    ?></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" style="text-align: right">
                                    Total :
                                </th>
                                <th>
                                    <h6 class="text-center fw-bold">
                                        {{ $totalterjual }}
                                    </h6>
                                </th>
                                <th>
                                    <h6 class="text-right fw-bold">
                                        Rp. <?php
                                        echo number_format($totalbeli, 0, ',', '.');
                                        ?>
                                    </h6>
                                </th>
                                <th>
                                    <h6 class="text-right fw-bold">
                                        Rp. <?php
                                        echo number_format($totaljual, 0, ',', '.');
                                        ?>
                                    </h6>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="4" style="text-align: right">
                                    Keuntungan :
                                </th>
                                <th colspan="3" class="fw-bold" style="text-align: right">
                                    <h5>Rp. <?php
                                    $angka = $totaljual - $totalbeli;
                                    echo number_format($angka, 0, ',', '.');
                                    ?></b>
                                </th>
                            </tr>
                        </tfoot>
                    @endif
                    @if ($tgl_awal == null || $tgl_akhir == null)
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            <tr>
                                <td>-</td>
                                <td>-</td>
                                <td>0</td>
                                <td>0</td>
                                <td style="text-align: center">0</td>
                                <td style="text-align: right">0</td>
                                <td style="text-align: right">0</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" style="text-align: right">
                                    Total :
                                </th>
                                <th>
                                    <h6 class="text-center fw-bold">
                                        0
                                    </h6>
                                </th>
                                <th>
                                    <h6 class="text-right fw-bold">
                                        Rp. 0
                                    </h6>
                                </th>
                                <th>
                                    <h6 class="text-right fw-bold">
                                        Rp. 0
                                    </h6>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="4" style="text-align: right">
                                    Keuntungan :
                                </th>
                                <th></th>
                                <th colspan="2" style="text-align: center">
                                    Rp. <?php
                                    $angka1 = 0;
                                    $angka2 = 0;
                                    $angka = 0;
                                    echo number_format($angka, 0, ',', '.');
                                    ?>
                                </th>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div> <!-- simple table -->
</div>
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.js">
</script>

{{-- <script>
    var table = $('#dataTable-1').DataTable({
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50, 100],
        "order": [
            [5, "desc"]
        ],
        "language": {
            "lengthMenu": "Menampilkan _MENU_ Data per halaman",
            "zeroRecords": "Maaf, tidak dapat menemukan apapun",
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_ halaman",
            "infoEmpty": "Tidak ada data yang dapat ditampilkan",
            "infoFiltered": "(dari _MAX_ total data)",
            "search": "Cari :",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "",
                "previous": ""
            },
            "dom": 'lrtip',
            "columnDefs": [{
                    type: 'date',
                    targets: 5
                } // Sesuaikan dengan indeks kolom tanggal Anda
            ],
        },

    });
</script> --}}
