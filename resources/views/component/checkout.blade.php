@include('navs')
<div class="site-section">
    <div class="container pl-5" style="max-width: 1300px">
        <div class="row mb-5">
            <div class="col-lg-7">
                <div class="col-lg-12 mb-4" style="border: solid 1px; border-radius: 5px">
                    <div class="row p-2">
                        <div class="col-12">
                            <h5 class="text-dark" style="font-weight:bold ">Pemesan</h5>
                        </div>
                        <div class="col-12">
                            <span class="text-dark">Mario Tangkas</span>
                        </div>
                        <div class="col-12">
                            <span class="text-dark">+62 812 3456 7890</span>
                        </div>
                        <div class="col-12">
                            <span class="text-dark">Mahasiswa</span>
                        </div>
                    </div>
                </div>
                @php
                    $total_pro = 0;
                    $total_pri = 0;
                @endphp
                @foreach ($item as $data)
                    <div class="col-lg-12 mb-4" style="border: solid 1px; border-radius: 5px">
                        <div class="row p-4">
                            <div class="col-lg-2" style="place-self: center">
                                <img src="/product-images/{{ $data->gambar_produk }}" alt="" class="w-100">
                            </div>
                            <div class="col-lg-6" style="place-self: center">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <span class="text-dark"
                                            style="font-weight: bold">{{ $data->nama_produk }}</span>
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Variasi : </span>
                                    </div>
                                    <div class="col-sm-12">
                                        <span class="text-dark">Jumlah Produk : {{ $data->jumlah }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 text-dark"
                                style="text-align-last: right; font-weight:bold; place-self:center">
                                <div class="row">
                                    <div class="col-12">
                                        Subtotal
                                    </div>
                                    <div class="col-12">
                                        Rp. <?php
                                        $angka = $data->jumlah_harga;
                                        echo number_format($angka, 0, ',', '.');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $total_pro += $data->jumlah;
                        $total_pri += $data->jumlah_harga;
                        $id_pes[] = $data->id;
                    @endphp
                @endforeach
            </div>
            <div class="col-lg-4 ml-3">
                <div class="row">
                    <div class="col-lg-12"
                        style="border:solid 1px; border-radius: 5px;max-height:250px; min-height:250px">
                        <div class="row pt-4 ml-1">
                            <div class="col-lg-12 pb-2">
                                <h5 class="text-dark" style="font-weight: bold">Total Pesanan</h5>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="text-dark">Total Produk</h5>
                                    </div>
                                    <div class="col-6 pr-5" style="text-align-last: right">
                                        <h6>{{ $total_pro }} Produk</h6>
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
                                        echo number_format($total_pri, 0, ',', '.');
                                        ?></h6>
                                    </div>
                                </div>
                            </div>
                            <hr class="pr-5" color="black" size="5" width="75%">
                            <form action="/checkout/produk" method="post">
                                @csrf
                                @php
                                    $idPes = implode(',', $id_pes);
                                @endphp
                                <input type="hidden" value="{{$idPes}}" name="id_pesanan" id="id_pesanan">
                                <div class="col-lg-12 pt-2" style="text-align-last:center">
                                    <p><button type="submit" class="buy-now btn btn-sm btn-primary">Pesan
                                            Sekarang</button></p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3" style="border:solid 1px; border-radius: 5px">
                        <div class="row pt-4 pb-4 ml-1">
                            <div class="col-lg-12 pb-2">
                                <h6 class="text-dark" style="font-weight: bold">Informasi Penting!</h6>
                            </div>
                            <div class="col-lg-12">
                                <span class="text-dark">Pengambilan dan pembayaran pesanan dilakukan di tempat.</span>
                            </div>
                            <div class="col-lg-12">
                                <span class="text-dark" style="font-weight: bold">Selamat belanja!</span>
                            </div>
                        </div>
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
