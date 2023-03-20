@extends('layouts.user')

@section('css')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
<link rel="stylesheet" href="{{ asset('css/laporan.css') }}">

@section('title', 'aduan - Aduan Masyarakat')

@section('content')
{{-- Section Header --}}
<section class="header bg-danger">


    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('pekat.index') }}">
                    <h2 class=" mt-0 text-white">Aduan Masyarakat</h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    @if(Auth::guard('masyarakat')->check())
                    <ul class="navbar-nav text-center ml-auto">
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="{{ route('pekat.laporan') }}">Laporan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="{{ route('pekat.logout') }}"
                                style="text-decoration: underline">{{ Auth::guard('masyarakat')->user()->nama }}</a>
                        </li>
                    </ul>
                    @else
                    <ul class="navbar-nav text-center ml-auto">
                        <li class="nav-item">
                            <button class="btn text-white" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#loginModal">Masuk</button>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pekat.formRegister') }}" class="btn btn-outline-purple">Daftar</a>
                        </li>
                    </ul>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

</section>
{{-- Section Card --}}
<body class="bg-danger">
<div class="container center">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-12 col-sm-12 col-12 col">
            <div class="content content-top shadow">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
                @endif
                @if (Session::has('pengaduan'))
                <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('pengaduan') }}</div>
                @endif
                <div class=" mb-3 text-center "><h1>Tulis Laporan Disini</h1></div>
                <form action="{{ route('pekat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" value="{{ old('judul_laporan') }}" name="judul_laporan" placeholder="Masukkan Judul Laporan"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea name="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control"
                            rows="4">{{ old('isi_laporan') }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ old('tgl_kejadian') }}" name="tgl_kejadian" placeholder="Pilih Tanggal Kejadian" class="form-control"
                            onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                    </div>
                    <div class="form-group">
                        <textarea name="lokasi_kejadian" rows="3" class="form-control" placeholder="Lokasi Kejadian">{{ old('lokasi_kejadian') }}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <select name="kategori_kejadian" class="custom-select" id="inputGroupSelect01" required>
                                <option value="" selected>Pilih Kategori Kejadian</option>
                                <option value="agama">Agama</option>
                                <option value="hukum">Hukum</option>
                                <option value="lingkungan">Lingkungan</option>
                                <option value="sosial">Sosial</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="file" name="foto" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-custom mt-2 bg-danger">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
{{-- Footer --}}

@endsection

@section('js')
@if (Session::has('pesan'))
<script>
    $('#loginModal').modal('show');

</script>
@endif
@endsection
