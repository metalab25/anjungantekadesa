<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg  blur blur-rounded top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                <div class="container-fluid px-0">
                    <img src="{{ $config->website . '/storage' . $config->logo }}" alt="Logo" width="35" class="ms-3">
                    <a class="navbar-brand font-weight-bolder ms-sm-2 me-0" href="{{ $config->website }}" rel="tooltip" title="{{ $setting->sebutan_desa.' '.$config->nama_desa}}" data-placement="bottom" target="_blank">
                        {{ 'Desa ' . $config->nama_desa }}
                    </a>
                    <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
                        <ul class="navbar-nav navbar-nav-hover col-lg-11 mx-auto">
                            <li class="nav-item dropdown dropdown-hover mx-2 mt-1">
                                <marquee class="pt-1" behavior="scroll" direction="left" scrollamount="5">
                                    Layanan Anjungan Mandiri akan ditutup sementara pada tanggal 22 Juli 2025 pukul 23:00 sampai dengan 04:00 karena adanya pemeliharaan sistem. Harap maklum. – <b>Pemerintah {{ $setting->sebutan_desa. ' '.$config->nama_desa}}</b>
                                </marquee>     
                            </li>
                        </ul>
                        <ul class="navbar-nav d-block">
                            <li class="nav-item">
                                @if(session('user'))
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                            <button type="submit" class="btn text-white bg-danger btn-round mb-0 me-1 mt-2 mt-md-0 float-end">Keluar</button>
                                        </form>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
