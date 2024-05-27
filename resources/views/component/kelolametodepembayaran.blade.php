<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<a href="/tambah/metode/pembayaran" class="btn btn-primary"> <i class="fa-solid fa-circle-plus pr-2"></i>Tambah Metode
    Pembayaran</a>
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
                            <th>No</th>
                            <th>Nama Layanan</th>
                            <th>Nomor Pembayaran</th>
                            <th>Nama Pemilik</th>
                            <th>Kategori Layanan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($metpem as $mp)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $mp->layanan }}</td>
                                <td>{{ $mp->no_layanan }}</td>
                                <td>{{ $mp->nama_pemilik }}</td>
                                <td>{{ $mp->kapem }}</td>
                                <td>
                                    @if ($mp->status_metpem == 'Aktif')
                                        <span class="badge badge-lg bg-success text-white"
                                            style="width: 100%; height: 100%;">{{ $mp->status_metpem }}</span>
                                    @else
                                        <span class="badge badge-lg bg-danger text-white"
                                            style="width: 100%; height: 100%;">{{ $mp->status_metpem }}</span>
                                    @endif
                                </td>
                                <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="text-muted sr-only">Action</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item"
                                            href="/ubah/metode/pembayaran/{{ $mp->id_metpem }}">Ubah</a>
                                        <button onclick="ubahstatusConfirmation()" class="dropdown-item">
                                            @if ($mp->status_metpem == 'Aktif')
                                                Non-Aktifkan
                                            @else
                                                Aktifkan
                                            @endif
                                        </button>
                                        <input type="hidden" name="idPes" id="idPes"
                                            value="{{ $mp->id_metpem }}">
                                    </div>
                                </td>
                                <script>
                                    function ubahstatusConfirmation() {
                                        var kode = $('#idPes').val();
                                        Swal.fire({
                                            title: 'Konfirmasi',
                                            text: 'Apakah Anda yakin ingin mengubah status kategori pembayaran ini?',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonText: 'Ya',
                                            cancelButtonText: 'Batal',
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = '/ubah/status/metode/pembayaran/' + kode;
                                            }
                                        });
                                    }
                                </script>
                            </tr>
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
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.js">
</script>

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
