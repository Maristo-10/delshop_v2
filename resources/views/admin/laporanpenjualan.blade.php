@extends('dashboard')
@section('title', 'Del Shop')
@section('navbar')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="/dashboard">Beranda</a></li>
            <li class="breadcrumb-item active">Manajemen Laporan</li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Penjualan</li>
        </ol>
    </nav>
@endsection
@section('halaman')
    Laporan Penjualan
@endsection
@section('content')
    @include('component.laporanpenjualan')
@endsection
