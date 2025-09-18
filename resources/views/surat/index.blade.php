@extends('layouts.surat')

@push('css')
<style>
    /* 🔍 Search bar full width */
    .search-wrapper {
        padding: 0 5px; /* kiri kanan 5px */
        margin-top: 6rem;
        margin-bottom: 1.5rem;
    }

    .search-box {
        position: relative;
        width: 100%;
    }

    .search-box input {
        width: 100%;
        padding: 12px 20px 12px 45px; /* space untuk ikon */
        border-radius: 20px; /* radius lebih bulat */
        border: 1px solid #ddd;
        background: #fafafa;
        font-size: 1rem;
    }

    .search-box input:focus {
        outline: none;
        border-color: #166CDA;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(22, 108, 218, 0.15);
    }

    .search-box i {
        position: absolute;
        top: 50%;
        left: 16px;
        transform: translateY(-50%);
        color: #999;
        font-size: 1.1rem;
    }

    /* 📝 Header section */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        margin-bottom: 0.25rem;
    }

    .section-header h4 {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
        color: #222;
    }

    .section-header a {
        font-size: 0.95rem;
        font-weight: 600;
        color: #166CDA;
        text-decoration: none;
    }

    .section-header a:hover {
        text-decoration: underline;
    }

    .section-subtitle {
        font-size: 0.95rem;
        color: #666;
        margin-bottom: 2rem;
    }

    /* Masonry container */
    #surat-container {
        column-count: 3;
        column-gap: 20px;
    }

    #surat-container .masonry-item {
        display: inline-block;
        width: 100%;
        margin-bottom: 20px;
        break-inside: avoid;
    }

    .item-surat {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 18px 22px;
        border-radius: 16px;
        background: #f5f6f8;
        transition: background 0.2s ease;
    }

    .item-surat i {
        font-size: 1.6rem;
        margin-right: 14px;
        padding: 12px;
        border-radius: 50%;
        background: #eef3ff;
        color: #2563eb;
    }

    .item-surat p {
        font-size: 0.85rem;
        font-weight: 600;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        #surat-container {
            column-count: 2;
        }
    }

    @media (max-width: 480px) {
        #surat-container {
            column-count: 1;
        }
    }
</style>
@endpush

@section('title', 'Daftar Surat')

@section('content')
<section class="pt-4 bg-white">
    <div class="container">
        {{-- 🔍 Search --}}
        <div class="search-wrapper mb-4">
            <form action="{{ route('surat.index') }}" method="GET" class="search-box">
                <i class="fal fa-magnifying-glass"></i>
                <input type="text"
                       id="search"
                       name="search"
                       placeholder="Cari surat..."
                       value="{{ old('search', $search ?? '') }}">
            </form>
        </div>

        {{-- 📝 Title & Arsip --}}
        <div class="section-header mt-4">
            <h4 class="font-poppins fw-bold">Pilih Layanan Pengajuan Surat</h4>
            <a href="{{ route('surat.arsip.surat') }}" class="fw-semibold">Arsip Surat</a>
        </div>
        <p class="section-subtitle">Layanan Pengajuan Surat Mandiri</p>

        {{-- 🧩 Masonry Grid --}}
        <div id="surat-container">
            @foreach ($surat as $s)
                <div class="masonry-item">
                    <a href="{{ route('layanan.surat.detail', $s['url_surat']) }}">
                        <div class="item-surat">
                            <i class="fal fa-file-alt"></i>
                            <p>{{ $s['nama'] ?? '-' }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        @include('layouts.copyright')
    </div>
</section>
@endsection
