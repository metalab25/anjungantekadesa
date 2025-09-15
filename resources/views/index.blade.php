@extends('layouts.app')

@push('css')
    <style>
        .card-plain .card-header {
            background-color: transparent;
        }

        /* Responsive untuk mobile (max-width: 768px) */
        @media (max-width: 768px) {
            .desktop-layout {
                flex-direction: column !important;
            }

            .banner-section {
                position: relative !important;
                width: 100% !important;
                height: 40vh !important;
                /* tinggi banner di mobile */
                top: auto !important;
                left: auto !important;
            }

            .banner-section img {
                width: 100% !important;
                height: 100% !important;
                object-fit: cover !important;
            }

            .form-section {
                position: relative !important;
                width: 100% !important;
                height: auto !important;
                top: auto !important;
                right: auto !important;
                display: flex !important;
                align-items: center;
                justify-content: center;
                margin-top: 1rem;
                padding: 1rem;
            }

            .form-card {
                width: 95% !important;
                max-width: 400px;
                margin: 0 auto;
            }
        }


        @media (width: 990px) and (height: 1440px) {
            .desktop-layout {
                flex-direction: column !important;
            }

            .banner-section {
                position: relative !important;
                width: 100% !important;
                height: 40vh !important;
                /* mirip desktop */
                top: auto !important;
                left: auto !important;
            }

            .banner-section img {
                width: 100% !important;
                height: 100% !important;
                object-fit: cover !important;
            }

            .form-section {
                position: relative !important;
                width: 100% !important;
                height: auto !important;
                top: auto !important;
                right: auto !important;
                display: flex !important;
                align-items: center;
                justify-content: center;
                margin-top: 1rem;
            }

            .form-card {
                width: 90% !important;
                max-width: 400px;
                margin: 0 auto;
            }
        }
    </style>
@endpush

@section('content')
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row desktop-layout">
                    <!-- Banner Section -->
                    <div
                        class="col-8 banner-section d-flex flex-column my-auto h-100 text-center justify-content-center pe-0 position-absolute top-0 start-0">
                        @php
                            $desaDomain = env('DESA_API');
                        @endphp
                        @if (!empty($banner) && count($banner) > 0)
                            <div
                                class="splide banner-container position-relative bg-gradient-primary h-100 m-3 my-4 border-radius-2xl d-flex flex-column justify-content-center overflow-hidden">
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
                            <div class="banner-container position-relative bg-gradient-primary h-100 m-3 my-4 px-7 border-radius-2xl d-flex flex-column justify-content-center"
                                style="background-image: url('{{ $apiBase . '/storage/' . $setting->header }}'); background-size: cover; background-position: center;">
                            </div>
                        @endif
                    </div>

                    <!-- Form Section -->
                    <div
                        class="col-4 form-section d-flex h-100 my-auto pe-0 position-absolute top-0 end-1 text-center justify-content-center flex-column">
                        <div class="card card-plain form-card">
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
                focus: 'center',
                autoplay: true,
                interval: 5000,
                arrows: false,
                pagination: false,
                easing: 'cubic-bezier(0.25, 0.46, 0.45, 0.94)',
                speed: 1000,
                perMove: 1,
                pauseOnHover: false,
                pauseOnFocus: false,
            }).mount();
        });
    </script>
@endpush
