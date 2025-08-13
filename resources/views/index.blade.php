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
                    <div
                        class="col-8 d-flex flex-column my-auto h-100 text-center justify-content-center pe-0 position-absolute top-0 start-0">
                        @php
                            $desaDomain = env('DESA_API');
                        @endphp
                        @if (count($banner) > 0)
                            <div
                                class="splide position-relative bg-gradient-primary h-100 m-3 my-4 border-radius-2xl d-flex flex-column justify-content-center overflow-hidden">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        @foreach ($banner as $item)
                                            <li class="splide__slide">
                                                <div class="w-full">
                                                    <img src="{{ $desaDomain . '/storage/' . $item['gambar'] }}"
                                                        style="width:100%; height:100vh; object-fit:cover;" alt="Banner">
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @else
                            <div class="position-relative bg-gradient-primary h-100 m-3 my-4 px-7 border-radius-2xl d-flex flex-column justify-content-center"
                                style="background-image: url('{{ $apiBase . '/storage/' . $setting->header }}');">
                            </div>
                        @endif
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

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Splide('.splide', {
                type: 'loop',
                perPage: 1,
                autoplay: true,
                arrows: false,
                interval: 3000,
            }).mount();
        });
    </script>
@endpush
