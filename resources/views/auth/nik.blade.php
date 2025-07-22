<div class="card-header pb-0 text-left">
    <div class="d-flex justify-content-center">
        <img src="{{ $config->website . '/storage' . $config->logo }}" alt="Logo" width="100" class="img-fluid">
    </div>
    <h4 class="font-weight-bolder">Anjungan Mandiri {{ $setting->sebutan_desa . ' ' . $config->nama_desa }}</h4>
</div>
<div class="card-body">
    @if ($errors->any())
        <div class="alert alert-danger border-radius-lg">
            <ul class="mb-0 text-capitalize" style="list-style-type: none">
                @foreach ($errors->all() as $error)
                    <li class="text-white">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('login.auth') }}" class="mb-4">
        @csrf
        <div class="form-group">
            <label class="form-label font-poppins fw-normal" for="nik">Nomor Induk Penduduk (NIK)</label>
            <input type="number" class="form-control text-center border-radius-lg" id="nik" name="nik"
                placeholder="Masukan NIK" value="{{ old('nik') }}" required autofocus>
        </div>
        <div class="form-group">
            <label class="form-label font-poppins fw-normal" for="pin">PIN Layanan Mandiri</label>
            <input type="password" class="form-control text-center border-radius-lg" id="pin" name="pin"
                required placeholder="Masukan PIN">
        </div>
        <button type="submit" class="btn btn-primary">MASUK LAYANAN MANDIRI</button>
    </form>
</div>
