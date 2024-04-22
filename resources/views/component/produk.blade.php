@include('navs')
<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-9 order-2">
                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="d-flex">
                            <div class="dropdown mr-1 ml-md-auto btn-group">
                                <button type="button" class="btn btn-sm dropdown-toggle text-white"
                                    id="dropdownMenuReference" data-toggle="dropdown"
                                    style="background-color: #00337C !important">Urutkan</button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                    <a class="dropdown-item" href="#">Semua Produk</a>
                                    <a class="dropdown-item" href="#">Terbaru</a>
                                    <a class="dropdown-item" href="#">Terlama</a>
                                    {{-- <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Price, low to high</a>
                                    <a class="dropdown-item" href="#">Price, high to low</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                        <div class="block-4 text-center border">
                            <figure class="block-4-image">
                                <a href="/detailproduk"><img src="pembeli/images/cloth_1.jpg" alt="Image placeholder"
                                        class="img-fluid"></a>
                            </figure>
                            <a href="/detailproduk">
                                <div class="block-4-text p-4">
                                    <h3>Tank Top</h3>
                                    <p class="mb-0">Rp. 100.000</p>
                                    <p class="text-primary font-weight-bold">Belum Terjual</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row" data-aos="fade-up">
                    <div class="col-md-12 text-center">
                        <div class="site-block-27">
                            <ul>
                                <li><a href="#">&lt;</a></li>
                                <li class="active"><span>1</span></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">&gt;</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 order-1 mb-5 mb-md-0">
                <div class="border p-4 rounded mb-4">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Kategori</h3>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><a href="#" class="d-flex"><span>Men</span> <span
                                    class="text-black ml-auto">(2,220)</span></a></li>
                        <li class="mb-1"><a href="#" class="d-flex"><span>Women</span> <span
                                    class="text-black ml-auto">(2,550)</span></a></li>
                        <li class="mb-1"><a href="#" class="d-flex"><span>Children</span> <span
                                    class="text-black ml-auto">(2,124)</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
