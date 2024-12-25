@extends('template', [
    'title' => 'Detail Jurnal Aktivitas',
])

@section('content')
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5>
                            Detail Jurnal Aktivitas
                        </h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            Detail informasi jurnal aktivitas.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-12 mb-1">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-2 mb-md-0">
                        Detail Jurnal Aktivitas Tanggal
                        {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>
                                <strong>
                                    Uraian Kegiatan
                                </strong>
                            </td>
                            <td class="w-100 text-wrap">
                                {{ $data->uraian_kegiatan }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    Hasil Kegiatan
                                </strong>
                            </td>
                            <td class="w-100 text-wrap">
                                {{ $data->hasil_kegiatan }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    Kendala
                                </strong>
                            </td>
                            <td class="w-100 text-wrap">
                                @if ($data->kendala)
                                    {{ $data->kendala }}
                                @else
                                    Tidak ada kendala.
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        @if ($data->files->isNotEmpty())
            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-2 mb-md-0">
                            Dokumen Pendukung Kegiatan
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach ($data->files as $file)
                            @if (in_array($file->file_type, ['png', 'jpg', 'jpeg']))
                                <a href="{{ asset('storage/' . $file->file_path) }}" data-lightbox="1">
                                    <img src="{{ asset('storage/' . $file->file_path) }}" alt="Lampiran"
                                        class="img-fluid img-thumbnail mb-2">
                                </a>
                            @elseif ($file->file_type == 'pdf')
                                <embed src="{{ asset('storage/' . $file->file_path) }}" type="application/pdf"
                                    width="100%" height="600px" class="mb-3" />
                            @else
                                Dokumen dengan format <strong class="text-danger">.{{ $file->file_type }}</strong> tidak
                                dapat ditampilkan di halaman ini. Silahkan download dokumen tersebut.
                            @endif
                        @endforeach
                    </div>
                    <div class="card-footer">
                        @foreach ($data->files as $file)
                            <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank"
                                class="btn btn-primary me-2">
                                Download Dokumen
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!-- [ Main Content ] end -->
@endsection

@push('styles')
    <!--lightbox css -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/plugins/lightbox.min.css') }}">
@endpush

@push('scripts')
    <!--lightbox Js -->
    <script src="{{ asset('assets/dashboard/js/plugins/lightbox.min.js') }}"></script>

    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
    </script>
@endpush
