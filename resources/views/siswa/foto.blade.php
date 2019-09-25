@extends('templates.header')

@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Siswa</h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="#" class="kt-subheader__breadcrumbs-home"> <i class="flaticon2-shelter"></i> </a>

                        <span class="kt-subheader__breadcrumbs-separator"></span>

                        <a href="" class="kt-subheader__breadcrumbs-link"> Siswa</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            @include('templates.errors')

            <div class="col-lg-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Foto {{ @$result->biodata->nama_lengkap }}
                            </h3>
                        </div>
                    </div>

                    <div class="kt-portlet__body">
                        <form action="{{ route('siswa.storeFoto') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="nis" value="{{ $result->nis }}" />
                            <div class="form-group">
                                <label>Foto</label>
                                <div></div>
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="customFile"> <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                        <hr />

                        <div class="row">
                            @foreach ($files ?? [] as $row)
                                <div class="col-lg-2">
                                    <img class="img-thumbnail" src="{{ url('images', $row) }}" alt="Picture Set"> <a href="{{ url('siswa/delete-foto/' . $result->nis . '/'. $row) }}" class="text-danger" style="position: absolute; top: 10px; right: 20px" href="#"><i class="fa fa-trash"></i></a>
                                </div>
                            @endforeach
                        </div>
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