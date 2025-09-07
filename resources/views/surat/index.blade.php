@extends('layouts.surat')

@push('css')
    <style>
        .item-surat {
            margin-bottom: 0;
            text-align: center;
            min-height: 105px;
        }

        .item-surat i {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .item-surat p {
            font-size: 0.8em;
            line-height: 1.3;
        }
    </style>
@endpush

@section('title', 'Daftar Surat')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="pt-8">
        <div class="container">
            <h3 class="text-center font-poppins mb-4">Daftar Surat</h3>
            <div class="row justify-content-center">
                <div class="col-md-6 mx-auto">
                    <form action="{{ route('surat.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-5">
                                <span class="input-group-text border-left-radius-3xl px-4"><i
                                        class="fal fa-magnifying-glass"></i></span>
                                <input class="form-control border-right-radius-3xl py-3" placeholder="Cari surat..."
                                    type="text" id="search" name="search" value="{{ old('search', $search ?? '') }}">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row" id="surat-container">
                    @foreach ($surat as $surat)
                        <div class="col-md-2 mx-auto">
                            <div class="card border-radius-xl mb-0 mb-sm-3">
                                <div class="card-body p-3">
                                    <a href="{{ route('layanan.surat.detail', $surat['url_surat']) }}">
                                        <div class="item-surat my-auto">
                                            <i class="fad fa-file-pdf text-info"></i>
                                            <p class="text-center mb-0">{{ $surat['nama'] ?? '-' }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @include('layouts.copyright')
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#search').on('input', function() {
                let keyword = $(this).val();

                $.ajax({
                    url: '/surat',
                    type: 'GET',
                    data: {
                        search: keyword
                    },
                    success: function(data) {
                        let html = '';
                        data.forEach(function(item) {
                            html += `
                        <div class="col-md-2 mx-auto">
                            <div class="card border-radius-xl mb-0 mb-sm-3">
                                <div class="card-body p-3">
                                    <a href="/layanan/surat/${item.url_surat}">
                                        <div class="item-surat my-auto">
                                            <i class="fad fa-file-pdf text-info"></i>
                                            <p class="text-center mb-0">${item.nama ?? '-'}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    `;
                        });
                        $('#surat-container').html(html);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            })
        })
    </script>
@endpush
