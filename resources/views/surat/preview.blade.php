@extends('layouts.surat')

@section('title', 'Preview Surat')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <iframe id="previewPdf" src="{{ asset($desa . '/storage/' . $path) }}#toolbar=0&navpanes=0&scrollbar=0"
                width="100%" style="border: none;height: 85vh;"></iframe>
        </div>
        <div class="row justify-content-between">
            <a href="{{ route('surat.index') }}" onclick="printIframe()" class="btn btn-danger w-auto mb-0 mt-2 ms-2">
                <i class="bi bi-printer me-1"></i> Kembali
            </a>
            <button onclick="printIframe()" class="btn btn-primary w-auto mb-0 mt-2 me-2">
                <i class="bi bi-printer me-1"></i> Print Surat
            </button>
        </div>
    </div>

    <script>
        function printIframe() {
            const iframe = document.getElementById('previewPdf');
            if (iframe) {
                iframe.focus();
                iframe.contentWindow.print();
            }
        }
    </script>
@endsection
