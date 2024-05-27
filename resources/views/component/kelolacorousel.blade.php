@php
    $no = 1;
    $no2 = 1;
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

<div class="col-10 p-3 bg-white shadow rounded m-5">
    @foreach ($corousel as $data)
        <div class="row m-3">
            <h4 class="fs-3">Carousel {{ $no++ }}</h4>
        </div>
        <div class="form-group col-12 col-md-6 m-3">
            <label for="gambar_corousel">Gambar Carousel</label>
            <img src="/corousel-images/{{ $data->gambar_corousel }}" alt="" class="w-100">
        </div>
        <div name="ubah-cr-{{ $data->id }}" id="ubah-cr-{{ $data->id }}">
            <div class="card-body d-sm-flex justify-content-between">
                <h6 class="col-md-7 mb-0">
                    <a href="#" class="btn btn-primary text-white py-2" data-toggle="modal"
                        data-target="#ubah-corousel-modal-{{ $data->id }}">
                        <i class="bi bi-pencil-square"></i> Ubah Gambar
                    </a>
                    @if ($data->status == 0)
                        <a href="/ubah-status-corousel/{{ $data->id }}" class="btn btn-success text-white py-2 col-5">
                            <i class="bi bi-check-circle-fill"></i> Aktifkan
                        </a>
                    @else
                        <a href="/ubah-status-corousel/{{ $data->id }}" class="btn btn-danger text-white col-5">
                            <i class="bi bi-slash-circle-fill"></i> Non-Aktifkan
                        </a>
                    @endif
                </h6>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="ubah-corousel-modal-{{ $data->id }}" tabindex="-1" role="dialog"
            aria-labelledby="ubah-corousel-modal-{{ $data->id }}-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ubah-corousel-modal-{{ $data->id }}-label">Ubah Gambar Carousel
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/ubah/corousel/{{ $data->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="gambar_corousel">Gambar Carousel</label>
                                <input type="file" name="gambar_corousel" id="gambar_corousel" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
