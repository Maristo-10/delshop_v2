<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <a href="/tambah/produk" class="btn btn-primary"> <i class="fa-solid fa-circle-plus pr-2"></i> Tambah Produk</a>
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
    <!-- Small table -->
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <!-- table -->
                <table class="table datatables" id="dataTable-1">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Modal (Rp)</th>
                            <th>Harga Jual (Rp)</th>
                            <th>Jumlah Produk</th>
                            <th>Kategori Pembeli</th>
                            <th>Kategori Produk</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($produk as $data)
                        <tr>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input">
                                    <label class="custom-control-label"></label>
                                </div>
                            </td>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->nama_produk }}</td>
                            <td><?php
                                $angka = $data->modal;
                                echo number_format($angka, 0, ',', '.');
                                ?></td>
                            <td><?php
                                $angka = $data->harga;
                                echo number_format($angka, 0, ',', '.');
                                ?></td>
                            <td><?php
                                $angka = $data->jumlah_produk;
                                echo number_format($angka, 0, ',', '.');
                                ?></td>
                            <td>{{ $data->role_pembeli }}</td>
                            <td>{{ $data->kategori_produk }}</td>
                            <td>
                                @if ($data->status_produk == "Aktif")
                                <span class="badge badge-lg bg-success text-white"
                                style="width: 100%; height: 100%;">{{ $data->status_produk }}</span>
                                @else
                                <span class="badge badge-lg bg-danger text-white"
                                style="width: 100%; height: 100%;">{{ $data->status_produk }}</span>
                                @endif

                            </td>
                            <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted sr-only">Action</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="/ubah/produk/{{$data->id_produk}}">Ubah</a>
                                    <a class="dropdown-item" href="/proses/ubah/status/produk/{{$data->id_produk}}">
                                        @if ($data->status_produk == 'Aktif')
                                            Non-Aktifkan
                                        @else
                                            Aktifkan
                                        @endif
                                    </a>
                                    <button class="dropdown-item" href="#" data-toggle="modal" data-target=".modal-detail-{{$data->id_produk}}">Detail</button>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade modal-detail-{{$data->id_produk}} modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="defaultModalLabel">Detail Produk</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="row">
                                        <div class="col-lg-12 text-center pb-1">
                                            <h4>{{$data->nama_produk}}</h4>
                                        </div>
                                        <div class="col-lg-12 text-center">
                                            <img class="w-25" src="/product-images/{{$data->gambar_produk}}" alt="">
                                        </div>
                                        <div class="col-lg-12 pt-3">
                                            <div class="row">
                                                <div class="col-5"><h5>Modal</h5></div>
                                                <div class="col-1"><h5> : </h5></div>
                                                <div class="col-6"><h5 class="text-secondary"> Rp. <?php
                                                    $angka = $data->modal;
                                                    echo number_format($angka, 0, ',', '.');
                                                    ?></h5></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 pt-3">
                                            <div class="row">
                                                <div class="col-5"><h5>Harga Jual</h5></div>
                                                <div class="col-1"><h5> : </h5></div>
                                                <div class="col-6"><h5 class="text-secondary"> Rp. <?php
                                                    $angka = $data->harga;
                                                    echo number_format($angka, 0, ',', '.');
                                                    ?></h5></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 pt-3">
                                            <div class="row">
                                                <div class="col-5"><h5>Jumlah Produk</h5></div>
                                                <div class="col-1"><h5> : </h5></div>
                                                <div class="col-6"><h5 class="text-secondary"><?php
                                                    $angka = $data->jumlah_produk;
                                                    echo number_format($angka, 0, ',', '.');
                                                    ?></h5></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 pt-3">
                                            <div class="row">
                                                <div class="col-5"><h5>Kategori Produk</h5></div>
                                                <div class="col-1"><h5> : </h5></div>
                                                <div class="col-6"><h5 class="text-secondary">{{ $data->kategori_produk }}</h5></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 pt-3">
                                            <div class="row">
                                                <div class="col-5"><h5>Kategori Pembeli</h5></div>
                                                <div class="col-1"><h5> : </h5></div>
                                                <div class="col-6"><h5 class="text-secondary">{{ $data->role_pembeli }}</h5></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 pt-3">
                                            <div class="row">
                                                <div class="col-12"><h5>Deskripsi</h5></div>
                                                <div class="col-12"><h5 class="text-secondary">{{ $data->deskripsi }}</h5></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                    </tbody>
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
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.js"></script>

<script>
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
  </script>
