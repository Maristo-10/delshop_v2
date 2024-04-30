@include('navs')
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
                                    <input type="checkbox" class="custom-control-input text-white" id="check">
                                    <label class="custom-control-label text-dark" style="font-weight: bold"
                                        for="check">Pilih
                                        semua</label>
                                </div>
                            </div>
                            <div class="col-md-7" style="text-align-last: right">
                                <a href="#"><span class="icon icon-trash" style="font-size: larger"></span></a>
                            </div>
                        </div>
                    </div>
                    @php
                        $no = 1;
                        $no2 = 1;
                    @endphp
                    @foreach ($detail_keranjang as $detail)
                        <div class="col-lg-12 mb-4" style="border: solid 1px; border-radius: 5px">
                            <div class="row p-4">
                                <div class="col-lg-1" style="place-self: center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input text-white" id="check2-{{$no++}}"
                                            name="selected_items[]" value="{{$detail->id}}">
                                        <label class="custom-control-label text-dark p-2" style="font-weight: bold"
                                            for="check2-{{$no2++}}"></label>
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
                                        <div class="col-sm-12">
                                            <span class="text-dark">Variasi : </span>
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
                                    <a href="#"><span class="icon icon-trash"
                                            style="font-size: larger"></span></a>
                                </div>
                                <div class="col-lg-3" style="place-self: center">
                                    <div class="input-group mb-3" style="max-width: 120px;">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-primary js-btn-minus"
                                                type="button">&minus;</button>
                                        </div>
                                        <input type="text" class="form-control text-center"
                                            value="{{ $detail->jumlah }}" placeholder=""
                                            aria-label="Example text with button addon" aria-describedby="button-addon1"
                                            id="jumlah_pes" name="jumlah_pes">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary js-btn-plus"
                                                type="button">&plus;</button>
                                        </div>
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
                                    <h6>{{ $total_pesanan }} Produk</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="text-dark">Total Harga Produk</h5>
                                </div>
                                <div class="col-6 pr-5" style="text-align-last: right">
                                    <h6>Rp. <?php
                                    $angka = $keranjang->total_harga;
                                    echo number_format($angka, 0, ',', '.');
                                    ?></h6>
                                </div>
                            </div>
                        </div>
                        <hr class="pr-5" color="black" size="5" width="75%">
                        <div class="col-lg-12 pt-2" style="text-align-last:center">
                            <p><button type="submit" class="buy-now btn btn-sm btn-primary">Lanjutkan Pemesanan</button></p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row mb-5">
            <div class="col-lg-7 mb-5" style="border: solid 1px; border-radius: 5px">
                <div class="row p-2">
                    <div class="col-md-5">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input text-white" id="check">
                            <label class="custom-control-label text-dark" style="font-weight: bold" for="check">Pilih
                                semua</label>
                        </div>
                    </div>
                    <div class="col-md-7" style="text-align-last: right">
                        <a href="#"><span class="icon icon-trash" style="font-size: larger"></span></a>
                    </div>
                </div>
            </div>
        </div> --}}
        </div>
    </div>
</form>
