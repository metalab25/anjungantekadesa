<div class="card-header pb-0 text-left">
    <div class="d-flex justify-content-center">
        <img src="{{ $config->website . '/storage' . $config->logo }}" alt="Logo" width="100" class="img-fluid">
    </div>
    <h4 class="font-weight-bolder">Anjungan Mandiri {{ $setting->sebutan_desa . ' ' . $config->nama_desa }}</h4>
</div>
<div class="card-body py-2">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0" style="list-style-type: none">
                @foreach ($errors->all() as $error)
                    <li class="text-white">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <img src="{{ asset('assets/img/scan_ktp.png') }}" alt="{{ config('app.nama') }}"
        srcset="{{ asset('assets/img/scan_ktp.png') }}" class="img-fluid">
    <form method="POST" action="{{ route('login.auth_ktp') }}" class="mb-4" id="loginKtpForm">
        @csrf
        <div class="form-group">
            <input type="hidden" class="form-control text-center" id="id_ktp" name="id_ktp"
                value="{{ old('id_ktp') }}" required autofocus>
        </div>
    </form>
</div>

@push('script')
    <script>
        let rfidBuffer = '';
        let timeout = null;

        document.addEventListener('keydown', function(e) {
            if (e.key.length === 1 || e.key === 'Enter') {
                if (timeout) clearTimeout(timeout);

                if (e.key === 'Enter') {
                    if (rfidBuffer.length > 0) {
                        document.getElementById('id_ktp').value = rfidBuffer;
                        document.getElementById('loginKtpForm').submit();
                        rfidBuffer = '';
                    }
                    return;
                }

                rfidBuffer += e.key;

                timeout = setTimeout(() => {
                    rfidBuffer = '';
                }, 1000);
            }
        });
    </script>
@endpush
