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

                        <a href="" class="kt-subheader__breadcrumbs-link"> Form Data Tahun Pelajaran</a>
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
                                Data Tahun Pelajaran
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{ url('tahun-pelajaran', @$result->nis) }}" method="POST">
                        @if(!empty($result))
                            @method('PATCH')
                        @endif

                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <label for="tahun_pelajaran" class="col-2 col-form-label">Tahun Pelajaran</label>
                                <div class="col-3">
                                    <input class="form-control" type="text" id="tahun_pelajaran" name="tahun_pelajaran" placeholder="Masukan Tahun Pelajaran" value="{{ old('nip', @$result->tahun_pelajaran) }}">
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