@extends('admin.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/select/bootstrap-select.min.css') }}">
@endsection

@section('title-header')
    <h3>karyawan</h3>
@endsection

@section('content')
    <div class="flex-column-fluid">
        <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">karyawan</span>
                </h3>

            </div>
            <form action="{{ route('admin.karyawan.store') }}" method="post">
                @csrf

                <div class="card-body">
                    @include('errors.alert')
                    <div class="row justify-content-md-center">
                        <div class="col-sm-6 align-content-center">
                            <div class="d-flex flex-column fv-row mb-8">
                                <label class="d-flex align-items-center fs-6 fw-bold required mb-2">
                                    <span>Nama</span>
                                </label>
                                <input type="text" name="nama" class="form-control form-control-sm " value="{{ old('nama') }}" required/>
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                    <span>Unit</span>
                                </label>
                                <select class="selectpicker form-control form-control-sm form-select-solid "  name="id_unit" id="id_unit" data-live-search="true" required>
                                    @foreach ($unit as $item)
                                        <option value="{{$item->id_unit}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex flex-column fv-row mb-8">
                                <label class="d-flex align-items-center fs-6 fw-bold required mb-2">
                                    <span>Email</span>
                                </label>
                                <input type="text" name="email" class="form-control form-control-sm "  value="{{ old('email') }}" required/>
                            </div>
                            <div class="d-flex flex-column fv-row mb-8" data-kt-password-meter="true">

                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Password</span>
                                </label>
                                <input type="text" name="password" class="form-control form-control-sm" required/>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-sm btn-primary w-250px" id="btnSubmit">
                                    <span class="indicator-label">Save</span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('assets/plugins/custom/select/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/select/bootstrap-select.min.js') }}"></script>
    <script>

        window.onbeforeunload = function () {
            $("button[type=submit]").prop("disabled", "disabled");
        }
        window.setTimeout(function () {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function () {
                $(this).remove();
            });
        }, 2000);
    </script>
@endsection
