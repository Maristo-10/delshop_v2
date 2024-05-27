@extends('dashboard')
@section('title', 'Del Shop')
@section('navbar')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="/dashboard">Beranda</a></li>
            <li class="breadcrumb-item active">Manajemen Pembayaran</li>
            <li class="breadcrumb-item"><a class="text-dark" href="/metode/pembayaran">Metode Pembayaran</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ubah Metode Pembayaran</li>
        </ol>
    </nav>
@endsection
@section('halaman')
    Ubah Metode Pembayaran
@endsection
@section('content')
    @include('component.ubahmetodepembayaran')
@endsection
