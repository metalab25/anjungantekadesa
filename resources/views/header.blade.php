<header class="header-2">
    <div class="page-header min-vh-75 relative"
        style="background-image: url('https://images.unsplash.com/photo-1445452916036-9022dfd33aa8?q=80&amp;w=2973&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 text-center mx-auto">
                    <h1 class="text-white pt-3 mt-n5 text-dark">{{ $setting->sebutan_desa . ' ' . $config->nama_desa }}
                    </h1>
                    <p class="text-white mt-3 hidden-xs">
                        {{ $config->alamat_kantor . ', ' . $setting->sebutan_kecamatan . ' ' . $config->nama_kecamatan . ', ' . $setting->sebutan_kabupaten . ' ' . $config->nama_kabupaten }}.
                        <br />
                        {{ 'Provinsi ' . $config->provinsi->nama . '. Kode Pos ' . $config->kode_pos }}
                        <br />
                        {{ 'Telepon : ' . $config->telepon }} {{ ' - Email : ' . $config->email_desa }}
                    </p>
                </div>
            </div>
        </div>

        <div class="position-absolute w-100 z-index-1 bottom-0">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
                    </path>
                </defs>
                <g class="moving-waves">
                    <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40"></use>
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)"></use>
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)"></use>
                    <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)"></use>
                    <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)"></use>
                    <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,0.95"></use>
                </g>
            </svg>
        </div>
    </div>
</header>
