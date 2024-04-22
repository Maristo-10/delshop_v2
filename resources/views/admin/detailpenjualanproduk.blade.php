@extends('dashboard')
@section('title', 'Del Shop')
@section('navbar')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="/dashboard">Beranda</a></li>
            <li class="breadcrumb-item active">Manajemen Produk</li>
            <li class="breadcrumb-item active" aria-current="page">Detail Penjualan Produk</li>
        </ol>
    </nav>
@endsection
@section('halaman')
    Detail Penjualan Produk
@endsection
@section('content')
    @include('component.detailpenjualanproduk')
@endsection
