@extends('dashboard')
@section('title', 'Del Shop')
@section('navbar')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="/dashboard">Beranda</a></li>
            <li class="breadcrumb-item active">Manajemen Pembayaran</li>
            <li class="breadcrumb-item"><a class="text-dark" href="/metode/pembayaran">Metode Pembayaran</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Metode Pembayaran</li>
        </ol>
    </nav>
@endsection
@section('halaman')
    Tambah Metode Pembayaran
@endsection
@section('content')
    @include('component.tambahmetodepembayaran')
@endsection
