<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <nav
                class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                <div class="container-fluid px-0">

                    <img src="{{ $apiBase . '/storage/' . $config->logo }}" alt="Logo" width="35" class="ms-3">
                    <a class="navbar-brand font-weight-bolder ms-sm-2 me-0" href="{{ $config->website }}" rel="tooltip"
                        title="{{ $setting->sebutan_desa . ' ' . $config->nama_desa }}" data-placement="bottom"
                        target="_blank">
                        {{ 'Desa ' . $config->nama_desa }}
                    </a>

                    <marquee behavior="scroll" direction="left" scrollamount="5" style="width: 100%; display: block;"
                        class="text-dark mt-2 mb-2 mx-3">
                        @foreach ($pengumuman as $index => $item)
                            {{ $item['judul'] }}
                            @if ($index + 1 !== collect($pengumuman)->count())
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                            @endif
                        @endforeach
                    </marquee>

                    <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0" id="navigation">
                        <ul class="navbar-nav d-flex gap-1 align-items-center">
                            <li class="nav-item">
                                @if (request()->segment(1) === 'arsip-surat')
                                    <a href="{{ route('surat.index') }}" style="white-space: nowrap;"
                                        class="btn float-end bg-primary btn-round mb-0 me-1 mt-2 mt-md-0 text-white">Surat</a>
                                @else
                                    <a href="{{ route('surat.arsip.surat') }}" style="white-space: nowrap;"
                                        class="btn float-end bg-primary btn-round mb-0 me-1 mt-2 mt-md-0 text-white">Arsip
                                        Surat</a>
                                @endif
                            </li>
                            <li class="nav-item">
                                @if (session('user'))
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="btn text-white bg-danger btn-round mb-0 me-1 mt-2 mt-md-0 float-end">Keluar</button>
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
