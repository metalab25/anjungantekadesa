@extends('layouts.app')

@push('css')
    <style>
        .card-plain .card-header {
            background-color: transparent;
        }
    </style>
@endpush

@section('content')
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div div
                        class="col-8 d-flex flex-column my-auto h-100 text-center justify-content-center pe-0 position-absolute top-0 start-0">
                        <div class="position-relative bg-gradient-primary h-100 m-3 my-4 px-7 border-radius-2xl d-flex flex-column justify-content-center"
                            style="background-image: url('{{ $apiBase . '/storage/' . $setting->header }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                            <h4 class="mt-5 text-white font-weight-bolder">
                                {{ $setting->sebutan_desa . ' ' . $config->nama_desa }}</h4>
                            <p class="text-white">
                                {{ $config->alamat_kantor . ', ' . $setting->sebutan_kecamatan . ' ' . $config->nama_kecamatan . ', ' . $setting->sebutan_kabupaten . ' ' . $config->nama_kabupaten }}.
                                <br />
                                {{ 'Kode Pos ' . $config->kode_pos }}
                                <br />
                                {{ 'Telepon : ' . $config->telepon }} {{ ' - Email : ' . $config->email_desa }}
                            </p>
                        </div>
                    </div>
                    <div
                        class="col-4 d-flex h-100 my-auto pe-0 position-absolute top-0 end-1 text-center justify-content-center flex-column">
                        <div class="card card-plain">
                            @if (request()->segment(2) == 'nik')
                                @include('auth.nik')
                            @elseif (request()->segment(2) == 'ktp')
                                @include('auth.ktp')
                            @else
                                @include('auth.index')
                            @endif
                            @include('layouts.copyright')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
