@include('navs')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    .custom-control-input:checked~.custom-control-label::before {
        background-color: #007bff;
        border-color: #007bff;
    }

    .custom-control-input:focus~.custom-control-label::before {
        box-shadow: 0 0 0 1px #007bff, 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .custom-control-input:hover:not(:disabled):not(:checked)~.custom-control-label::before {
        border-color: #007bff;
    }

    .custom-checkbox .custom-control-label::before {
        border-radius: 0.25rem;
        background-color: white;
        border: solid 1px;
    }

    .custom-checkbox .custom-control-input:checked~.custom-control-label::before::after {
        position: absolute;
        display: block;
        left: 0.6rem;
        top: 0.2rem;
        width: 0.5rem;
        height: 1rem;
        content: '';
        background: red;
        border: solid #007bff;
        border-width: 0 0.2rem 0.2rem 0;
        transform: rotate(45deg);
    }
</style>
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
<form action="/proses/checkout" method="post">
    @csrf
    <div class="site-section">
        <div class="container pl-5" style="max-width: 1300px">
            <div class="row mb-5">
                <div class="col-lg-7">
                    <div class="col-lg-12 mb-4" style="border: solid 1px; border-radius: 5px">
                        <div class="row p-2">
                            <div class="col-md-5">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input text-white" id="checkAll">
                                    <label class="custom-control-label text-dark" style="font-weight: bold"
                                        for="checkAll">Pilih
                                        semua</label>
                                </div>
                            </div>
                            {{-- <div class="col-md-7" style="text-align-last: right">
                                <a href="#"><span class="icon icon-trash" style="font-size: larger"></span></a>
                            </div> --}}
                        </div>
                    </div>
                    @php
                        $no = 1;
                        $no2 = 1;
                        $no3 = 1;
                    @endphp
                    @foreach ($detail_keranjang as $detail)
                        <div class="col-lg-12 mb-4" style="border: solid 1px; border-radius: 5px">
                            <div class="row p-4">
                                <div class="col-lg-1" style="place-self: center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input text-white"
                                            id="check2-{{ $no++ }}" name="selected_items[]"
                                            value="{{ $detail->id }}">
                                        <label class="custom-control-label text-dark p-2" style="font-weight: bold"
                                            for="check2-{{ $no2++ }}"></label>
                                    </div>
                                </div>
                                <div class="col-lg-2" style="place-self: center">
                                    <img src="/product-images/{{ $detail->gambar_produk }}" alt=""
                                        class="w-100">
                                </div>
                                <div class="col-lg-5" style="place-self: center">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <span class="text-dark">{{ $detail->nama_produk }}</span>
                                        </div>
                                        @php
                                            $varPesanan = json_decode($detail->variasi_pes, true);
                                            $j = 0;
                                        @endphp
                                        <div class="col-sm-12">
                                            <span class="text-dark">Variasi :</span>
                                            @if ($detail->variasi_pes != null)
                                                @for ($i = 0; $i < count($varPesanan); $i++)
                                                    <span class="text-dark">{{ $varPesanan[$i][1] }}</span>
                                                    @if ($i < count($varPesanan) - 1)
                                                        ,
                                                    @endif
                                                @endfor
                                            @else
                                                <span></span>
                                            @endif

                                        </div>
                                        <div class="col-sm-12">
                                            <span class="text-dark" style="font-weight: bold">Rp.
                                                <?php
                                                $angka = $detail->jumlah_harga;
                                                echo number_format($angka, 0, ',', '.');
                                                ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1" style="place-self: center">
                                    <button type="button" class="btn btn-light" onclick="hapusConfirmation()"><span
                                            class="icon icon-trash" style="font-size: larger"></span></button>
                                </div>
                                <script>
                                    function hapusConfirmation() {
                                        Swal.fire({
                                            title: 'Konfirmasi',
                                            text: 'Apakah Anda yakin ingin menghapus data ini?',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonText: 'Ya',
                                            cancelButtonText: 'Batal',
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = "/hapus/keranjang/{{ $detail->id }}";
                                            }
                                        });
                                    }
                                </script>
                                <div class="col-lg-3" style="place-self: center">
                                    <div class="input-group mb-3" style="max-width: 120px;">
                                        <input type="text" class="form-control text-center"
                                            value="{{ $detail->jumlah }}" placeholder=""
                                            aria-label="Example text with button addon" aria-describedby="button-addon1"
                                            id="jumlah_pes" name="jumlah_pes" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-4 ml-3"
                    style="border:solid 1px; border-radius: 5px;max-height:200px; min-height:200px">
                    <div class="row pt-4 ml-1">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="text-dark">Total Produk</h5>
                                </div>
                                <div class="col-6 pr-5" style="text-align-last: right">
                                    <h6 id="totalProduk">0 Produk</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="text-dark">Total Harga Produk</h5>
                                </div>
                                <div class="col-6 pr-5" style="text-align-last: right">
                                    <h6 id="totalHarga">Rp. <?php
                                    $angka = 0;
                                    echo number_format($angka, 0, ',', '.');
                                    ?></h6>
                                </div>
                            </div>
                        </div>
                        <hr class="pr-5" color="black" size="5" width="75%">
                        <div class="col-lg-12 pt-2" style="text-align-last:center">
                            <p><button type="submit" class="buy-now btn btn-sm btn-primary">Lanjutkan
                                    Pemesanan</button></p>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $('#checkAll').click(function() {
                        // Mengatur semua checkbox sesuai dengan status checkbox "Pilih Semua"
                        $('input[name="selected_items[]"]').prop('checked', this.checked);
                        updateTotal();
                    });

                    // Mengupdate total setiap kali checkbox individu diubah
                    $('input[name="selected_items[]"]').change(function() {
                        updateTotal();
                    });

                    function updateTotal() {
                        let totalItems = 0;
                        let totalPrice = 0;
                        let checkedItems = $('input[name="selected_items[]"]:checked');
                        let requests = [];
                        console.log("legth", checkedItems.length)
                        if (checkedItems.length === 0) {
                            $('#totalProduk').text('0');
                            $('#totalHarga').text('Rp. 0');
                            return;
                        }

                        // Mengumpulkan semua permintaan AJAX
                        checkedItems.each(function() {
                            let itemId = $(this).val();
                            let request = $.ajax({
                                url: '/data/pesanan/' + itemId,
                                type: 'GET',
                                dataType: 'json'
                            });

                            requests.push(request);
                        });

                        // Menunggu semua permintaan selesai
                        $.when.apply($, requests).done(function() {
                            let args = arguments;
                            console.log(args);
                            totalItems = 0;
                            totalPrice = 0;

                            // Memproses setiap respons AJAX
                            if (checkedItems.length > 1) {
                                for (let i = 0; i < args.length; i++) {
                                    let data = args[i][0];
                                    console.log('Data from response:', data);

                                    if (data) {
                                        totalItems += data.jumlah || 0;
                                        totalPrice += data.jumlah_harga || 0;
                                    }
                                }
                            } else {
                                let data = args[0];
                                console.log('Data from response:', data);

                                if (data) {
                                    totalItems += data.jumlah || 0;
                                    totalPrice += data.jumlah_harga || 0;
                                }
                            }
                            $('#totalProduk').text(totalItems);
                            $('#totalHarga').text(totalPrice.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }));
                            console.log('Total Items:', totalItems);
                            console.log('Total Price:', totalPrice);
                        }).fail(function(xhr, status, error) {
                            console.error('AJAX Error: ' + status + ' ' + error);
                            $('#productDetail').html('<p class="text-danger">Product not found</p>');
                        });
                    }
                });
            </script>




        </div>
    </div>
</form>
