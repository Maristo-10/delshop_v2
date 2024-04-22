@extends('home')
@section('title', 'Del Shop')
@section('navbar')
    <div class="col-md-12 mb-0 text-white"><a href="/" class="text-white">Beranda</a> <span class="mx-2 mb-0">/</span> <strong>Produk</strong></div>
@endsection
@section('content')
    @include('component.produk')
@endsection
