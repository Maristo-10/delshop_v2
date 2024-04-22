@extends('home')
@section('title', 'Del Shop')
@section('navbar')
<div class="col-md-12 mb-0 text-white"><a href="/" class="text-white">Beranda</a><span class="mx-2 mb-0">/ <a href="/keranjang" class="text-white">Keranjang</a><span class="mx-2 mb-0">/</span><strong>Checkout</strong></div>
@endsection
@section('content')
    @include('component.checkout')
@endsection
