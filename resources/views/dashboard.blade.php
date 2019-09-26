@extends('templates.header')

@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Dashboard</h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="#" class="kt-subheader__breadcrumbs-home"> <i class="flaticon2-shelter"></i> </a>

                        <span class="kt-subheader__breadcrumbs-separator"></span>

                        <a href="" class="kt-subheader__breadcrumbs-link"> Dashboard</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="col-lg-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title float-left">
                                Laporan Terkini
                            </h3>
                        </div>
                    </div>

                    <div class="kt-portlet__body">
                        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                            <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Pelapor</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Jenis Pelanggaran</th>
                                <th>Catatan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pelanggaran as $row)
                                <tr>
                                    <td>{{ @$row->created_at->format('d m Y H:i:s') }}</td>
                                    <td>{{ @$row->guru->biodata->nama_lengkap }}</td>
                                    <td>{{ @$row->siswa->nis }}</td>
                                    <td>{{ @$row->siswa->biodata->nama_lengkap }}</td>
                                    <td>{{ @$row->siswa->detail_kelas->kelas->nama_kelas }}</td>
                                    <td>{{ @$row->jenis_pelanggaran_label }}</td>
                                    <td>{{ @$row->catatan }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
@endsection