@extends('layouts.surat')

@section('title', 'Arsip Surat')

@section('content')
    <section class="pt-8">
        <div class="container">
            <h3 class="text-center font-poppins mb-4">Arsip Surat</h3>
            <div class="row justify-content-center align-items-center">
                <div class="row">
                    <table class="table bg-white">
                        <thead>
                            <tr>
                                <th scope="col">no</th>
                                <th scope="col">Nama Surat</th>
                                <th scope="col">Status</th>
                                <th scope="col">Tanggal Pengajuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($arsip as $index => $item)
                                <tr>
                                    <th>{{ $index + 1 }}</th>
                                    <td>{{ $item['nama_surat'] }}</td>
                                    <td>{{ $item['status'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item['created_at'])->format('d-m-Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @include('layouts.copyright')
            </div>
    </section>
@endsection
