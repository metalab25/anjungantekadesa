@push('css')
<style>
    /* Override warna navbar - timpa semua warna navbar */
    .navbar-expand-lg,
    .navbar-expand-lg.blur,
    .navbar {
        background: #2c3e50 !important; /* Ganti dengan warna yang Anda inginkan */
        background-color: #2c3e50 !important;
    }

    /* Pastikan navbar selalu menampilkan konten dengan benar */
    .navbar-brand {
        flex-shrink: 0;
        color: white !important; /* Sesuaikan warna text dengan background */
    }

    .marquee-container {
        flex-grow: 1;
        overflow: hidden;
        margin: 0 15px;
    }

    .navbar-nav-container {
        flex-shrink: 0;
    }

    /* Warna text marquee */
    .marquee-container marquee {
        color: white !important; /* Sesuaikan dengan background */
    }

    /* Media query untuk layar medium ke atas (desktop) */
    @media (min-width: 768px) {
        .navbar .container-fluid {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-brand-section {
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        .marquee-container {
            flex: 1;
            margin: 0 20px;
        }

        .navbar-nav-container {
            flex-shrink: 0;
        }

        .navbar-collapse {
            display: block !important;
        }

        .btn-logout {
            display: inline-block !important;
            white-space: nowrap;
        }
    }

    /* Media query KHUSUS untuk monitor portrait touchscreen (900x1440) */
    @media (min-width: 900px) and (max-height: 1440px) {
        /* Paksa navbar tampil seperti desktop */
        .navbar-collapse {
            display: block !important; /* Paksa tampilkan menu */
            visibility: visible !important;
        }

        .navbar .container-fluid {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
        }

        .navbar-brand-section {
            display: flex !important;
            align-items: center !important;
            flex-shrink: 0 !important;
        }

        .marquee-container {
            flex: 1 !important;
            margin: 0 25px !important;
        }

        .navbar-nav-container {
            flex-shrink: 0 !important;
        }

        .btn-logout {
            display: inline-block !important;
            font-size: 1.1rem !important;
            padding: 10px 22px !important;
            border-radius: 10px !important;
            white-space: nowrap !important;
        }
    }

    /* Media query untuk layar desktop besar */
    @media (min-width: 1200px) {
        .btn-logout {
            font-size: 1.1rem !important;
            padding: 10px 22px !important;
            border-radius: 10px !important;
        }
    }

    /* Pastikan tombol logout tidak pernah hilang */
    .btn-logout {
        display: inline-block !important;
        visibility: visible !important;
    }
</style>
@endpush

<div class="mx-5 position-sticky z-index-sticky top-0">
    <div class="row">
        <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0">
            <div class="container-fluid px-0">

                <!-- Logo dan Nama Desa Section -->
                <div class="navbar-brand-section">
                    <img src="{{ $apiBase . '/storage/' . $config->logo }}" alt="Logo" width="35" class="ms-3">
                    <a class="navbar-brand font-weight-bolder ms-sm-2 me-0" href="{{ $config->website }}" rel="tooltip"
                        title="{{ $setting->sebutan_desa . ' ' . $config->nama_desa }}" data-placement="bottom"
                        target="_blank">
                        {{ 'Desa ' . $config->nama_desa }}
                    </a>
                </div>

                <!-- Marquee Section -->
                <div class="marquee-container">
                    <marquee behavior="scroll" direction="left" scrollamount="5" style="width: 100%; display: block;"
                        class="mt-2 mb-2">
                        @foreach ($pengumuman as $index => $item)
                            {{ $item['judul'] }}
                            @if ($index + 1 !== collect($pengumuman)->count())
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                            @endif
                        @endforeach
                    </marquee>
                </div>

                <div class="navbar-nav-container">
                    <div class="navbar-collapse" id="navigation">
                        <ul class="navbar-nav d-flex gap-1 align-items-center">
                            <li class="nav-item">
                                @if (session('user'))
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit"
                                            class="btn text-white bg-danger btn-round mb-0 me-3 mt-2 mt-md-0 btn-logout">
                                            Keluar
                                        </button>
                                    </form>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </nav>
    </div>
</div>
