@include('navs')
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
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="/product-images/{{ $produk->gambar_produk }}" alt="Image" class="img-fluid"
                    style="max-height: 350px">
            </div>
            <div class="col-md-6">
                <h2 class="text-black">{{ $produk->nama_produk }}</h2>
                <p><strong class="text-primary h4">Rp. <?php
                $angka = $produk->harga;
                echo number_format($angka, 0, ',', '.');
                ?></strong></p>
                <p class="text-dark">{{ $produk->deskripsi }}</p>

                {{-- <div class="mb-1 d-flex">
                    <label for="option-sm" class="d-flex mr-3 mb-3">
                        <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio"
                                id="option-sm" name="shop-sizes"></span> <span
                            class="d-inline-block text-black">Small</span>
                    </label>
                    <label for="option-md" class="d-flex mr-3 mb-3">
                        <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio"
                                id="option-md" name="shop-sizes"></span> <span
                            class="d-inline-block text-black">Medium</span>
                    </label>
                    <label for="option-lg" class="d-flex mr-3 mb-3">
                        <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio"
                                id="option-lg" name="shop-sizes"></span> <span
                            class="d-inline-block text-black">Large</span>
                    </label>
                    <label for="option-xl" class="d-flex mr-3 mb-3">
                        <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio"
                                id="option-xl" name="shop-sizes"></span> <span class="d-inline-block text-black"> Extra
                            Large</span>
                    </label>
                </div> --}}
                <form action="/tambah/keranjang/{{$produk->id_produk}}" method="POST">
                    @csrf
                    <div class="row col-md-12">
                        <div class="mb-5 mt-2">
                            <div class="input-group mb-3" style="max-width: 120px;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                                </div>
                                <input type="text" class="form-control text-center" value="1" placeholder=""
                                    aria-label="Example text with button addon" aria-describedby="button-addon1" id="jumlah_pes" name="jumlah_pes">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5 ml-4" style="place-self: center">
                            <h6 class="text-dark" style="font-weight: bold"> Tersisa : {{ $produk->jumlah_produk }}
                            </h6>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <p><button type="submit" class="buy-now btn btn-sm btn-primary">Tambah ke Keranjang</button></p>
                        </div>
                        <div class="col-md-6">
                            <p><a href="cart.html" class="buy-now btn btn-sm btn-primary">Beli Sekarang</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
