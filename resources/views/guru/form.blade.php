@extends('templates.header')

@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Guru</h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="#" class="kt-subheader__breadcrumbs-home"> <i class="flaticon2-shelter"></i> </a>

                        <span class="kt-subheader__breadcrumbs-separator"></span>

                        <a href="" class="kt-subheader__breadcrumbs-link"> Form Data Guru</a>
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
                                Data Guru
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form kt-form--label-right" action="{{ url('guru', @$result->id) }}" method="POST">
                        @if(!empty($result))
                            @method('PATCH')
                        @endif

                        @csrf
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <label for="nip" class="col-2 col-form-label">NIP</label>
                                <div class="col-3">
                                    <input class="form-control" type="text" id="nip" name="nip" placeholder="Masukan NIP" value="{{ old('nip', @$result->nip) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_lengkap" class="col-2 col-form-label">Nama Lengkap</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Masukan Nama Lengkap" value="{{ old('nama_lengkap', @$result->biodata->nama_lengkap) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_lengkap" class="col-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-10">
                                    <div class="kt-radio-inline">
                                        <label class="kt-radio"> <input type="radio" value="L" name="jenis_kelamin" {{ old('jenis_kelamin', @$result->biodata->jenis_kelamin) == "L" ? 'checked' : '' }}> Laki-Laki <span></span> </label>


                                        <label class="kt-radio"> <input type="radio" value="P" name="jenis_kelamin" {{ old('jenis_kelamin', @$result->biodata->jenis_kelamin) == "P" ? 'checked' : '' }}> Perempuan <span></span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tempat_lahir" class="col-2 col-form-label">Tempat Lahir</label>
                                <div class="col-3">
                                    <input class="form-control" type="text" id="tempat_lahir" name="tempat_lahir" placeholder="Masukan Tempat Lahir" value="{{ old('tempat_lahir', @$result->biodata->tempat_lahir) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tanggal_lahir" class="col-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-3">
                                    <input class="form-control" type="text" id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukan Tanggal Lahir" value="{{ old('tanggal_lahir', !empty($result->biodata->tanggal_lahir) ? $result->biodata->tanggal_lahir->format('Y-m-d') : '') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="agama" class="col-2 col-form-label">Agama</label>
                                <div class="col-3">
                                    <input class="form-control" type="text" id="agama" name="agama" placeholder="Masukan Agama" value="{{ old('agama', @$result->biodata->agama) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat_jalan" class="col-2 col-form-label">Alamat</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" id="alamat_jalan" name="alamat_jalan" placeholder="Masukan Alamat (Contoh: Jl. Bojongloa No. 80A)" value="{{ old('alamat_jalan', @$result->biodata->alamat_jalan) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat_rt" class="col-2 col-form-label">RT</label>
                                <div class="col-2">
                                    <input class="form-control" type="number" id="alamat_rt" name="alamat_rt" placeholder="Masukan RT" value="{{ old('alamat_rt', @$result->biodata->alamat_rt) }}">
                                </div>

                                <label for="alamat_rw" class="col-2 col-form-label">RW</label>
                                <div class="col-2">
                                    <input class="form-control" type="number" id="alamat_rw" name="alamat_rw" placeholder="Masukan RW" value="{{ old('alamat_rw', @$result->biodata->alamat_rw) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat_desa" class="col-2 col-form-label">Kelurahan / Desa</label>
                                <div class="col-5">
                                    <input class="form-control" type="text" id="alamat_desa" name="alamat_desa" placeholder="Masukan Kelurahan / Desa" value="{{ old('alamat_desa', @$result->biodata->alamat_desa) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat_kecamatan" class="col-2 col-form-label">Kecamatan</label>
                                <div class="col-5">
                                    <input class="form-control" type="text" id="alamat_kecamatan" name="alamat_kecamatan" placeholder="Masukan Kecamatan" value="{{ old('alamat_kecamatan', @$result->biodata->alamat_kecamatan) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat_kota" class="col-2 col-form-label">Kota/Kab</label>
                                <div class="col-5">
                                    <input class="form-control" type="text" id="alamat_kota" name="alamat_kota" placeholder="Masukan Kota/Kab" value="{{ old('alamat_kota', @$result->biodata->alamat_kota) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat_pos" class="col-2 col-form-label">Kodepos</label>
                                <div class="col-2">
                                    <input class="form-control" type="number" id="alamat_pos" name="alamat_pos" placeholder="Masukan Kodepos" value="{{ old('alamat_pos', @$result->biodata->alamat_pos) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telp_mobile" class="col-2 col-form-label">No Handphone</label>
                                <div class="col-3">
                                    <input class="form-control" type="text" id="telp_mobile" name="telp_mobile" placeholder="Masukan No Handphone" value="{{ old('telp_mobile', @$result->biodata->telp_mobile) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-2 col-form-label">Email</label>
                                <div class="col-5">
                                    <input class="form-control" type="email" id="email" name="email" placeholder="Masukan Email" value="{{ old('email', @$result->biodata->email) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-2 col-form-label">Username</label>
                                <div class="col-5">
                                    <input class="form-control" type="text" id="username" name="username" placeholder="Masukan Username" value="{{ old('username', @$result->username) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-2 col-form-label">Password</label>
                                <div class="col-5">
                                    <input class="form-control" type="password" id="password" name="password" placeholder="Masukan Password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="repassword" class="col-2 col-form-label">Password (Ulangi)</label>
                                <div class="col-5">
                                    <input class="form-control" type="password" id="repassword" name="repassword" placeholder="Masukan Password (Ulangi)">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="level" class="col-2 col-form-label">Level</label>
                                <div class="col-5">
                                    <select class="form-control" id="level" name="level">
                                        <option value="" {{ empty(old('level', @$result->level)) ? 'selected' : '' }}>- Pilih Level Guru -</option>
                                        <option value="0" {{ old('level', @$result->level) == 0 ? 'selected' : '' }}>Guru</option>
                                        <option value="1" {{ old('level', @$result->level) == 1 ? 'selected' : '' }}>Administrator</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kategori_guru" class="col-2 col-form-label">Kategori Guru</label>
                                <div class="col-5">
                                    <select class="form-control" id="kategori_guru" name="kategori_guru">
                                        <option value="" {{ empty(old('kategori_guru', @$result->kategori_guru)) ? 'selected' : '' }}>- Pilih Kategori Guru -</option>
                                        <option value="1" {{ old('kategori_guru', @$result->kategori_guru) == 1 ? 'selected' : '' }}>Guru PNS</option>
                                        <option value="2" {{ old('kategori_guru', @$result->kategori_guru) == 2 ? 'selected' : '' }}>Guru Non-PNS</option>
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