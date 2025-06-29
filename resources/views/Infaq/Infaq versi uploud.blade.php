@php 
use Illuminate\Support\Facades\Auth; 
@endphp
@extends('layouts/layoutMaster')

@section('title', 'Data Infaq')

@section('vendor-style')
@vite([
    'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
    'resources/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.scss',
    'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
    'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
    'resources/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.scss',
    'resources/assets/vendor/libs/@form-validation/form-validation.scss',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
    'resources/assets/vendor/libs/spinkit/spinkit.scss'
])
@endsection

@section('vendor-script')
@vite([
    'resources/assets/vendor/libs/jquery/jquery.js',
    'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
    'resources/assets/vendor/libs/moment/moment.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js',
    'resources/assets/vendor/libs/@form-validation/popular.js',
    'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/auto-focus.js',
    'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
])
@endsection

@section('page-script')
@vite(['resources/assets/js/tables-datatables-infaq.js'])
@endsection

@section('content')
<meta name="flash-success" content="{{ session('success') }}">
<meta name="flash-error" content="{{ session('error') }}">
<meta name="user-role" content="{{ Auth::user()->getRoleNames()->first() }}">

<main class="app-main">
    <div class="app-content">
        <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h3 class="card-title mb-0">Data Infaq</h3>
            @role('donatur')
            <a href="{{ route('infaq.create') }}" class="btn btn-primary btn-sm">
                <i class="ri-add-line"></i> Tambah Infaq
            </a>
            @endrole
            </div>

            <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table table-bordered">
                <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Donatur</th>
                    <th>Nominal</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    @role('admin')
                    <th>Aksi</th>
                    @endrole
                </tr>
                </thead>
                <tbody>
                @forelse ($infaqs as $key => $infaq)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $infaq->donatur->nama ?? 'Tidak diketahui' }}</td>
                    <td>Rp {{ number_format($infaq->nominal, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($infaq->tanggal)->format('d M Y') }}</td>
                    <td>
                        @if(Auth::user()->hasRole('admin'))
                            @if($infaq->bukti_pembayaran)
                                <button type="button"
                                    class="btn btn-info btn-sm btn-lihat-bukti"
                                    data-id="{{ $infaq->id_infaq }}"
                                    data-bukti="{{ asset('storage/' . $infaq->bukti_pembayaran) }}"
                                    data-keterangan="{{ $infaq->keterangan }}"
                                    data-bs-toggle="modal" data-bs-target="#buktiModal">
                                    Lihat Bukti
                                </button>
                            @else
                                <span class="text-muted">Tidak ada bukti</span>
                            @endif
                        @else
                            {{ $infaq->keterangan }}
                        @endif
                    </td>
                    <td>
                    @if($infaq->status === 'paid')
                        <span class="badge bg-success">Lunas</span>
                    @elseif($infaq->status === 'pending')
                        <span class="badge bg-warning text-dark">Menunggu</span>
                    @elseif($infaq->status === 'failed')
                        <span class="badge bg-danger">Gagal</span>
                    @else
                        <span class="badge bg-secondary">{{ ucfirst($infaq->status) }}</span>
                    @endif
                    </td>
                    @role('admin')
                    <td>
                        @if($infaq->status === 'pending')
                            <form action="{{ route('infaq.terima', $infaq->id_infaq) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm btn-terima">Terima</button>
                            </form>
                            <form action="{{ route('infaq.tolak', $infaq->id_infaq) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm btn-tolak">Tolak</button>
                            </form>
                        @else
                            <em>-</em>
                        @endif
                    </td>
                    @endrole
                </tr>
                @empty
                @endforelse
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
</main>

<!-- Modal Bukti Pembayaran -->
<div class="modal fade" id="buktiModal" tabindex="-1" aria-labelledby="buktiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="buktiModalLabel">Bukti Pembayaran</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center">
            <img id="buktiImage" src="" class="img-fluid mb-3" style="max-height: 400px;">
            <p class="text-muted" id="buktiKeterangan"></p>
        </div>
        </div>
    </div>
</div>
@endsection