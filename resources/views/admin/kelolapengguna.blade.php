@extends('dashboard')
@section('title', 'Del Shop')
@section('navbar')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-dark" href="/dashboard">Beranda</a></li>
            <li class="breadcrumb-item active">Manajemen Pengguna</li>
            <li class="breadcrumb-item active" aria-current="page">Kelola Pengguna</li>
        </ol>
    </nav>
@endsection
@section('halaman')
    Kelola Pengguna
@endsection
@section('content')
    @include('component.kelolapengguna')
@endsection
