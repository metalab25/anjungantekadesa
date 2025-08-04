<div class="card-header pb-0 text-left">
    <div class="d-flex justify-content-center">
        <img src="{{ $apiBase . '/storage/' . $config->logo }}" alt="Logo" width="100" class="img-fluid">
    </div>
    <h4 class="font-outfit font-weight-bold">Anjungan Mandiri {{ $setting->sebutan_desa . ' ' . $config->nama_desa }}
    </h4>
    <a href="{{ route('login.ktp') }}" class="btn btn-lg bg-gradient-success border-radius-xl btn-lg w-100 mb-0 mt-4">Login
        Dengan Scan KTP</a>
    <p class="my-2">- Atau -</p>
    <a href="{{ route('login.nik') }}"
        class="btn btn-lg bg-gradient-primary border-radius-xl btn-lg w-100 mb-3">Login Dengan NIK</a>
</div>
<div class="card-footer text-center pt-0 px-lg-2 px-1">
    <p class="mb-4 text-sm mx-auto">
        Belum Memiliki Akun Layanan Mandiri ?<br>
        <a href="javascript:;" class="text-primary text-gradient font-weight-bold">Hubungi Admin
            {{ $setting->sebutan_desa }}</a>
    </p>
</div>
