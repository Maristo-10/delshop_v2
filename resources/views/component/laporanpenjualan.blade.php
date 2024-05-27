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
        <form class="" action="/laporan/penjualan" id="form-caritanggal" method="get"
            enctype="multipart/form-data">
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
                        <form class="" action="/export/laporan/penjualan" id="form-exportlaporanpenjualan"
                            method="get" enctype="multipart/form-data">
                            <input type="hidden" name="awal" id="awal" value="{{ $tgl_awal }}">
                            <input type="hidden" name="akhir" id="akhir" value="{{ $tgl_akhir }}">
                            <button type="submit" class="btn btn-success mb-4"><i
                                    class="fa-solid fa-file-excel pr-1"></i>Export
                                Excel</button>
                        </form>
                @endif
            </div>
            <!-- table -->
            <table class="table datatables" id="dataTable-1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Pesanan</th>
                        <th>Tanggal Pesanan</th>
                        <th>Nama Pemesan</th>
                        <th>Metode Pembayaran</th>
                        <th>Jumlah Produk</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                @if ($tgl_awal != null && $tgl_akhir != null)
                    <tbody>
                        @php
                            $no = 1;
                            $jlhpes = 0;
                            $hargapes = 0;
                        @endphp
                        @foreach ($pesanan as $pes)
                            @php
                                $user = App\Models\User::where('id', $pes->user_id)->first();
                                $metpem = App\Models\MetodePembayaran::where('id_metpem', $pes->nama_layanan)->first();
                                $detailpes = App\Models\DetailPesanan::where('pesanan_id', $pes->id)->get();
                                $jumlahdet = 0;
                                foreach ($detailpes as $det) {
                                    $jumlahdet += $det->jumlah;
                                }
                                $jlhpes += $jumlahdet;
                                $hargapes += $pes->total_harga;
                            @endphp
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $pes->kode }}</td>
                                <td>{{ $pes->tanggal }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $metpem->layanan }}</td>
                                <td>{{ $jumlahdet }}</td>
                                <td style="text-align: right">Rp. <?php
                                $angka = $pes->total_harga;
                                echo number_format($angka, 0, ',', '.');
                                ?></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" style="text-align: right"> Total Produk Terjual :

                            </td>
                            <td style="text-align: right"><b>{{ $jlhpes }} Produk</b></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align: right">Total Harga Produk Terjual :</td>
                            <td style="text-align: right"><b>Rp. <?php
                            echo number_format($hargapes, 0, ',', '.');
                            ?></b></td>
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
                            <td>-</td>
                            <td>-</td>
                            <td>0</td>
                            <td>-</td>
                            <td style="text-align: right">Rp. 0</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" style="text-align: right"><b>Jumlah Produk Terjual : 0 Produk</b>
                            </td>
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
