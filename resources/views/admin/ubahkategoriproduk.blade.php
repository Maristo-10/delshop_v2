@extends('dashboard')
@section('title', 'Del Shop')
@section('navbar')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="/dashboard">Beranda</a></li>
            <li class="breadcrumb-item active">Manajemen Produk</li>
            <li class="breadcrumb-item"><a class="text-dark" href="/kelola/kategori-produk">Kelola Kategori Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Kategori Produk</li>
        </ol>
    </nav>
@endsection
@section('halaman')
    Ubah Kategori Produk
@endsection
@section('content')
    @include('component.ubahkategoriproduk')
@endsection
