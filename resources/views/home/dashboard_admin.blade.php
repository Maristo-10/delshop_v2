@extends('dashboard')
@section('navbar')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"> Beranda</li>
        </ol>
    </nav>
@endsection
@section('halaman')
    Dashboard
@endsection
@section('content')
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
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <small class="mb-1" style="font-weight: bold">Produk Terjual</small><br>
                            <small class="text-muted mb-5">Tahun 2024</small>
                            <h3 class="card-title mb-0 mt-2">{{ $produk_terjual }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <span class=""><i class="fa-solid fa-cart-shopping fa-2xl"
                                    style="color:forestgreen"></i></span>
                        </div>
                    </div> <!-- /. row -->
                </div> <!-- /. card-body -->
            </div> <!-- /. card -->
        </div>
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <small class="mb-1" style="font-weight: bold">Pendapatan</small><br>
                            <small class="text-muted mb-1">Tahun 2024</small>
                            <h3 class="card-title mb-0 mt-2">Rp. <?php
                            echo number_format($untung, 0, ',', '.'); ?></h3>
                        </div>
                        <div class="col-4 text-right">
                            <span class=""><i class="fa-solid fa-money-bill-1-wave fa-2xl"
                                    style="color:slateblue"></i></span>
                        </div>
                    </div> <!-- /. row -->
                </div> <!-- /. card-body -->
            </div> <!-- /. card -->
        </div>
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <small class="mb-1" style="font-weight: bold">Pengguna</small><br>
                            <small class="text-muted mb-1">Semua</small>
                            <h3 class="card-title mb-0 mt-2">{{ $pengguna }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <span class=""><i class="fa-solid fa-user fa-2xl" style="color:indianred"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Statistik Pendapatan <span> Bulanan</span></h5>

                    <!-- Line Chart -->
                    <div id="pendapatanChart"></div>
                    <script src="https://code.highcharts.com/stock/highstock.js"></script>
                    <script>
                        var totalspem = <?php echo json_encode($totalpemasukan); ?>;
                        var totalspro = <?php echo json_encode($totalproduk); ?>;
                        var bulans = <?php echo json_encode($bulan); ?>;
                        var tahuns = <?php echo json_encode($tahun); ?>;
                        Highcharts.chart('pendapatanChart', {
                            title: {
                                text: 'Statistik Data Penjualan ' + tahuns
                            },
                            xAxis: {
                                categories: bulans,
                            },

                            yAxis: {
                                title: {
                                    text: 'Total Keuangan'
                                }
                            },
                            plotOptions: {
                                series: {
                                    allowPointSelect: true
                                }
                            },
                            series: [{
                                name: 'Total Pendapatan',
                                data: totalspem
                            }],
                        });
                    </script>
                    <!-- End Line Chart -->

                </div>
            </div>
        </div>

        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Statistik Data Pesanan<span> Bulanan</span></h5>

                    <!-- Line Chart -->
                    <div id="produkChart"></div>
                    <script src="https://code.highcharts.com/stock/highstock.js"></script>
                    <script>
                        var totalspem = <?php echo json_encode($totalpemasukan); ?>;
                        var totalspro = <?php echo json_encode($totalproduk); ?>;
                        var bulans = <?php echo json_encode($bulan); ?>;
                        var tahuns = <?php echo json_encode($tahun); ?>;
                        Highcharts.chart('produkChart', {
                            title: {
                                text: 'Statistik Data Pesanan ' + tahuns
                            },
                            xAxis: {
                                categories: bulans,
                            },

                            yAxis: {
                                title: {
                                    text: 'Total Pesanan'
                                }
                            },
                            plotOptions: {
                                series: {
                                    allowPointSelect: true
                                }
                            },
                            series: [{
                                name: 'Total Pesanan',
                                data: totalspro
                            }],
                        });
                    </script>
                    <!-- End Line Chart -->
                </div>
            </div>
        </div>
    </div>
@endsection
