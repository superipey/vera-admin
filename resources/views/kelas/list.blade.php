@extends('templates.header')

@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Kelas</h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="#" class="kt-subheader__breadcrumbs-home"> <i class="flaticon2-shelter"></i> </a>

                        <span class="kt-subheader__breadcrumbs-separator"></span>

                        <a href="" class="kt-subheader__breadcrumbs-link"> Kelas</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="col-lg-12">
                @include('templates.errors')
            </div>

            <div class="col-lg-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title float-left">
                                Data Kelas
                            </h3>
                        </div>

                        <div class="kt-portlet__head-label float-right">
                            <a href="{{ route('kelas.create') }}" class="btn btn-outline-success btn-square"><i class="fa fa-plus"></i> Tambah</a>
                        </div>
                    </div>

                    <div class="kt-portlet__body">

                        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kelas</th>
                                <th>Nama Wali Kelas</th>
                                <th>Jumlah Siswa</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($result ?? [] as $row)
                                <tr>
                                    <td>{{ isset($i) ? ++$i : $i = 1 }}</td>
                                    <td>{{ @$row->nama_kelas }}</td>
                                    <td>{{ @$row->guru->biodata->nama_lengkap }}</td>
                                    <td>{{ count(@$row->detail_kelas) ?? 0 }}</td>
                                    <td nowrap>
                                        <a href="{{ route('kelas.edit', $row->id) }}" class="btn btn-sm btn-warning"><span class="fa fa-pencil-alt"></span></a>

                                        @if (count(@$row->detail_kelas) == 0)
                                            <form action="{{ route('kelas.destroy', $row->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link href="{{ asset('assets') }}/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@push('script')
    <script src="{{ asset('assets') }}/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
    <script>
      $(function () {
        table = $(".table").DataTable({
          responsive: true,
          // DOM Layout settings
          lengthMenu: [5, 10, 25, 50],
          pageLength: 10,
        });
      });
    </script>
@endpush