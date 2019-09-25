@extends('templates.header')

@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Tahun Pelajaran</h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="#" class="kt-subheader__breadcrumbs-home"> <i class="flaticon2-shelter"></i> </a>

                        <span class="kt-subheader__breadcrumbs-separator"></span>

                        <a href="" class="kt-subheader__breadcrumbs-link"> Tahun Pelajaran</a>
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
                                Data Tahun Pelajaran
                            </h3>
                        </div>

                        <div class="kt-portlet__head-label float-right">
                            <a href="{{ route('tahun-pelajaran.create') }}" class="btn btn-outline-success btn-square"><i class="fa fa-plus"></i> Tambah</a>
                        </div>
                    </div>

                    <div class="kt-portlet__body">

                        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun Pelajaran</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($result ?? [] as $row)
                                <tr>
                                    <td>{{ isset($i) ? ++$i : $i = 1 }}</td>
                                    <td>{{ @$row->tahun_pelajaran }}</td>
                                    <td nowrap>
                                        @if(@$row->status != 1)
                                        <a href="{{ route('tahun-pelajaran.aktif', $row->id) }}" class="btn btn-sm btn-info"><span class="fa fa-check"></span></a>
                                        @endif

                                        <a href="{{ route('tahun-pelajaran.edit', $row->id) }}" class="btn btn-sm btn-warning"><span class="fa fa-pencil-alt"></span></a>

                                        <form action="{{ route('tahun-pelajaran.destroy', $row->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></button>
                                        </form>
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