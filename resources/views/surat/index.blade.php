@extends('layouts.surat')

@section('title', 'Daftar Surat')

@section('search')
<div class="row">
    <div class="col-md-6 mx-auto">
        <form action="{{ route('surat.index') }}" method="GET">
            <div class="form-group">
                <div class="input-group mb-5">
                    <span class="input-group-text px-3"><i class="ni ni-zoom-split-in"></i></span>
                    <input class="form-control py-3" placeholder="Cari surat..." type="text" id="search" name="search" value="{{ old('search', $search ?? '') }}">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    @foreach ($surat as $surat)
        <div class="col-md-2 mx-auto">
            <div class="card mb-0 mb-sm-3">
                <div class="card-body p-3">
                    <a href="{{ route('layanan.surat.detail', $surat['url_surat']) }}">
                        <div class="item-surat">
                            <i class="fad fa-file-pdf text-info"></i>
                            <p class="mb-0">{{ $surat['nama'] ?? '-' }}</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
