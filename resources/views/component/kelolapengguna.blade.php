<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<a href="/tambah/pengguna" class="btn btn-primary"> <i class="fa-solid fa-circle-plus pr-2"></i> Tambah Pengguna</a>
<a href="/import/pengguna" class="btn btn-success ml-3"> <i class="fa-solid fa-file-import pr-2 text-white"></i> Import Excel</a>
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
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                            <th>Role Pengguna</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($user as $peng)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{$peng->name}}</td>
                            <td>{{$peng->email}}</td>
                            <td>{{$peng->role_pengguna}}</td>
                            <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted sr-only">Action</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" href="#" data-toggle="modal"
                                        data-target=".modal-detail-{{$peng->id}}">Detail</button>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade modal-detail-{{$peng->id}} modal-slide" tabindex="-1" role="dialog"
                            aria-labelledby="defaultModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="defaultModalLabel">Detail Pengguna</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row">
                                            <div class="col-lg-12 text-center pb-1">
                                                <h4></h4>
                                            </div>
                                            <div class="col-lg-12 text-center mb-2">
                                                <img class="w-25 p-2" src="/user-images/{{$peng->gambar_pengguna}}" alt="" style="border: solid 5px; border-radius:50%">
                                            </div>
                                            <div class="col-lg-12 pt-3">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <h5>Nama</h5>
                                                    </div>
                                                    <div class="col-1">
                                                        <h5> : </h5>
                                                    </div>
                                                    <div class="col-6"><h5><b>{{$peng->name}}</b></h5></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 pt-3">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <h5>Email</h5>
                                                    </div>
                                                    <div class="col-1">
                                                        <h5> : </h5>
                                                    </div>
                                                    <div class="col-6"><h5><b>{{$peng->email}}</b></h5></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 pt-3">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <h5>Jenis Kelamin</h5>
                                                    </div>
                                                    <div class="col-1">
                                                        <h5> : </h5>
                                                    </div>
                                                    <div class="col-6"><h5><b>{{$peng->jenis_kelamin}}</b></h5></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 pt-3">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <h5>Kategori Pengguna</h5>
                                                    </div>
                                                    <div class="col-1">
                                                        <h5> : </h5>
                                                    </div>
                                                    <div class="col-6"><h5>{{$peng->role_pengguna}}</h5></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 pt-3">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <h5>No. Telepon</h5>
                                                    </div>
                                                    <div class="col-1">
                                                        <h5> : </h5>
                                                    </div>
                                                    <div class="col-6"><h5><b>{{$peng->no_telp}}</b></h5></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 pt-3">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <h5>Alamat</h5>
                                                    </div>
                                                    <div class="col-1">
                                                        <h5> : </h5>
                                                    </div>
                                                    <div class="col-6"><h5><b>{{$peng->alamat}}</b></h5></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn mb-2 btn-secondary"
                                            data-dismiss="modal">Tutup</button>
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
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/r-2.2.2/sc-2.0.0/datatables.min.js">
</script>

<script>
    var table = $('#dataTable-1').DataTable({
        "pageLength": 5,
        "lengthMenu": [5, 10, 25, 50, 100],
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
