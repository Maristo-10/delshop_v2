@extends('dashboard')
@section('title', 'Del Shop')
@section('navbar')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="/dashboard">Beranda</a></li>
            <li class="breadcrumb-item active">Manajemen Pesanan</li>
            <li class="breadcrumb-item active" aria-current="page">Konfirmasi Pesanan</li>
        </ol>
    </nav>
@endsection
@section('halaman')
    Konfirmasi Pesanan
@endsection
@section('content')
    @include('component.konfirmasipesanan')
@endsection
