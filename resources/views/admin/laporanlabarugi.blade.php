@extends('dashboard')
@section('title', 'Del Shop')
@section('navbar')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="/dashboard">Beranda</a></li>
            <li class="breadcrumb-item active">Manajemen Laporan</li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Laba Rugi</li>
        </ol>
    </nav>
@endsection
@section('halaman')
    Laporan Laba Rugi
@endsection
@section('content')
    @include('component.laporanlabarugi')
@endsection
