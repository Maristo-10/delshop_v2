@extends('home')

@section('content')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <style>
        /* CSS untuk mengubah warna ikon */
        .carousel-control-prev-icon {
            filter: invert(100%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(100%) contrast(100%);
        }

        .carousel-control-next-icon {
            filter: invert(100%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(100%) contrast(100%);
        }
    </style>
    </style>
    <div class="container mt-2">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="pembeli/images/sdf.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="pembeli/images/qwe.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev"
                style="border-color: unset; background-color:transparent;justify-content:left">
                <span class="carousel-control-prev-icon ml-4" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next"
                style="border-color: unset; background-color:transparent;justify-content:right">
                <span class="carousel-control-next-icon mr-4" aria-hidden="true"></span>
            </a>
        </div>
    </div>
    <script>
        // Inisialisasi Carousel
        $(document).ready(function() {
            $('.carousel').carousel();
        });
    </script>

    {{-- <div class="site-section site-section-sm site-blocks-1">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
                    <div class="icon mr-4 align-self-start">
                        <span class="icon-truck"></span>
                    </div>
                    <div class="text">
                        <h2 class="text-uppercase">Free Shipping</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer
                            accumsan tincidunt fringilla.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon mr-4 align-self-start">
                        <span class="icon-refresh2"></span>
                    </div>
                    <div class="text">
                        <h2 class="text-uppercase">Free Returns</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer
                            accumsan tincidunt fringilla.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon mr-4 align-self-start">
                        <span class="icon-help"></span>
                    </div>
                    <div class="text">
                        <h2 class="text-uppercase">Customer Support</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at iaculis quam. Integer
                            accumsan tincidunt fringilla.</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="site-section site-blocks-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="h3 mb-3 text-black">Kategori Produk</h2>
                </div>
                <div class="row col-md-12 justify-content-center">
                    <div class="col-sm-6 col-md-6 col-lg-2 mb-4 mb-lg-0">
                        <a class="block-2-item" href="#">
                            <figure class="image">
                                <img src="pembeli/images/women.jpg" alt="" class="img-fluid">
                            </figure>
                            <div class="text">
                                <span class="text-uppercase">Collections</span>
                                <h6>Women</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-2 mb-5 mb-lg-0">
                        <a class="block-2-item" href="#">
                            <figure class="image">
                                <img src="pembeli/images/children.jpg" alt="" class="img-fluid">
                            </figure>
                            <div class="text">
                                <span class="text-uppercase">Collections</span>
                                <h6>Children</h6>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-2 mb-5 mb-lg-0">
                        <a class="block-2-item" href="#">
                            <figure class="image">
                                <img src="pembeli/images/men.jpg" alt="" class="img-fluid">
                            </figure>
                            <div class="text">
                                <span class="text-uppercase">Collections</span>
                                <h6>Men</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Rekomendasi Produk</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="nonloop-block-3 owl-carousel">
                        <div class="item col-10">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="pembeli/images/cloth_1.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Tank Top</a></h3>
                                    <p class="mb-0">Rp. 100.000</p>
                                    <p class="text-primary font-weight-bold">Belum Terjual</p>
                                </div>
                            </div>
                        </div>
                        <div class="item col-10">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="pembeli/images/cloth_1.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Tank Top</a></h3>
                                    <p class="mb-0">Rp. 100.000</p>
                                    <p class="text-primary font-weight-bold">Belum Terjual</p>
                                </div>
                            </div>
                        </div>
                        <div class="item col-10">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="pembeli/images/cloth_1.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Tank Top</a></h3>
                                    <p class="mb-0">Rp. 100.000</p>
                                    <p class="text-primary font-weight-bold">Belum Terjual</p>
                                </div>
                            </div>
                        </div>
                        <div class="item col-10">
                            <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="pembeli/images/cloth_1.jpg" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Tank Top</a></h3>
                                    <p class="mb-0">Rp. 100.000</p>
                                    <p class="text-primary font-weight-bold">Belum Terjual</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
