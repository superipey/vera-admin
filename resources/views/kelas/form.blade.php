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

                        <a href="" class="kt-subheader__breadcrumbs-link"> Form Data Kelas</a>
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
                            <h3 class="kt-portlet__head-title">
                                Data Kelas
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{ url('kelas', @$result->id) }}" method="POST">
                        @if(!empty($result))
                            @method('PATCH')
                        @endif

                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <label for="nama_kelas" class="col-2 col-form-label">Nama Kelas</label>
                                <div class="col-3">
                                    <input class="form-control" type="text" id="nama_kelas" name="nama_kelas" placeholder="Masukan Nama Kelas" value="{{ old('nama_kelas', @$result->nama_kelas) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="id_biodata" class="col-2 col-form-label">Wali Kelas</label>
                                <div class="col-10">
                                    <select class="form-control" id="id_guru" name="id_guru">
                                        <option value="" {{ empty(old('id_guru', @$result->id_guru)) ? 'selected' : '' }}>- Pilih Wali Kelas -</option>
                                        @foreach ($waliKelas ?? [] as $row)
                                            <option value="{{ $row->id }}" {{ old('id_guru', @$result->id_guru) == $row->id ? 'selected' : '' }}>{{ $row->biodata->nama_lengkap }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-2">
                                    </div>
                                    <div class="col-10">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection