@extends('dashboard')
@section('title', 'Del Shop')
@section('navbar')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="/dashboard">Beranda</a></li>
            <li class="breadcrumb-item active">Manajemen Pesanan</li>
            <li class="breadcrumb-item active" aria-current="page">Pesanan Dibatalkan</li>
        </ol>
    </nav>
@endsection
@section('halaman')
    Pesanan Dibatalkan
@endsection
@section('content')
    @include('component.pesanandibatalkan')
@endsection
