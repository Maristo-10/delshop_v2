@extends('dashboard')
@section('title', 'Del Shop')
@section('navbar')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="/dashboard">Beranda</a></li>
            <li class="breadcrumb-item active">Manajemen Pembayaran</li>
            <li class="breadcrumb-item"><a class="text-dark" href="/kategori/pembayaran">Kategori Pembayaran</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Kategori Pembayaran</li>
        </ol>
    </nav>
@endsection
@section('halaman')
    Ubah Kategori Pembayaran
@endsection
@section('content')
    @include('component.ubahkategoripembayaran')
@endsection
