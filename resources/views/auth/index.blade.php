@push('css')
    <style>
        @media (min-width: 900px) and (height: 1440px) {
            .title-anjungan {
                font-size: 2rem !important;
                /* lebih besar dari default */
                font-weight: 600 !important;
                line-height: 1.3 !important;
            }

            .btn {
                font-size: 1.5rem !important;
                /* perbesar teks tombol */
                padding: 1.25rem 2rem !important;
                /* perbesar tombol */
                border-radius: 1rem !important;
                /* biar lebih proporsional */
            }

            .btn-nik {
                background: #166CDA;
                color: white;
                max-width: 350px;
            }

            .btn-ktp {
                background: #7CE336;
                color: #000000;
                max-width: 350px;
            }

            .card-footer p,
            .card-footer a {
                font-size: 1.2rem !important;
            }
        }
    </style>
@endpush

<div class="text-left mb-4">
    <div class="d-flex justify-content-center mb-3">
        <img src="{{ $apiBase . '/storage/' . $config->logo }}" alt="Logo" width="100" class="img-fluid">
    </div>
    <h4 class="font-outfit font-weight-bold title-anjungan">
        Selamat Datang di Sistem Pelayanan {{ $setting->sebutan_desa . ' ' . $config->nama_desa }} (Anjungan Mandiri)
    </h4>
    <p class="my-2 text-center">Cetak surat lebih cepat dan efisian </p>

    <p class="p-login my-2 mt-5 text-center fs-4">Silahkan pilih metode login anda</p>
    <a href="{{ route('login.nik') }}" class="btn-nik btn btn-lg border-radius-xl w-100 mb-0 mt-4 ">
        Login Dengan NIK
    </a>
    <p class="my-2 text-center">- Atau -</p>
    <a href="{{ route('login.ktp') }}" class="btn-ktp btn btn-lg bg-gradient-success border-radius-xl w-100 mb-3">
        Login Dengan Scan KTP
    </a>
</div>

