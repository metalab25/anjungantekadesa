@push('css')
    <style>
        .modal-md-custom {
            max-width: 400px;
        }
    </style>
@endpush

<div class="modal fade" id="rfIdModal" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.5);">

    <div class="modal-dialog modal-md-custom modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content">

            <div class="modal-body">

                <div class="alert alert-danger text-white">

                    Silakan daftarkan KTP Anda dengan menempelkannya di alat di bawah layar.

                </div>

                <img src="{{ asset('assets/img/scan_ktp.png') }}" alt="{{ config('app.nama') }}"
                    srcset="{{ asset('assets/img/scan_ktp.png') }}" class="w-100">

                <form action="{{ route('penduduk_mandiri.update_id_ktp', $user['penduduk_id']) }}" id="rfIdForm"
                    method="POST">
                    @csrf
                    @method('POST')
                    <input type="text" name="id_ktp" id="rfidInput" style="position: absolute; left: -9999px;" readonly>
                </form>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-danger btn-sm mb-0" data-bs-dismiss="modal">Tutup</button>

            </div>

        </div>

    </div>

</div>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            @if ($showRfIdModal)

                var modalEl = document.getElementById('rfIdModal');

                if (modalEl) {

                    var myModal = new bootstrap.Modal(modalEl, {

                        backdrop: 'static',

                        keyboard: false

                    });

                    myModal.show();

                }
            @endif

            let rfidBuffer = '';
            let timeout = null;

            document.addEventListener('keydown', function(e) {
                if (e.key.length === 1 || e.key === 'Enter') {
                    if (timeout) clearTimeout(timeout);

                    if (e.key === 'Enter') {
                        if (rfidBuffer.length > 0) {
                            document.getElementById('rfidInput').value = rfidBuffer;
                            document.getElementById('rfIdForm').submit();
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

        });
    </script>
@endpush
