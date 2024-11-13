@extends('admin.layouts.index')

@section('css')
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

            <div class="card-body">
                @include('errors.alert')
                <div class="row justify-content-md-center">
                    <div class="col-sm-6 align-content-center">
                        <div class="d-flex flex-column fv-row mb-8">

                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Nama</span>
                            </label>

                            <input type="text" class="form-control form-control-sm bg-light-dark"
                                   value="{{ $one?->nama }}" disabled/>
                        </div>
                        <div class="d-flex flex-column fv-row mb-8">

                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Unit</span>
                            </label>

                            <input type="text" class="form-control form-control-sm bg-light-dark"
                                   value="{{ $one?->unit }}" disabled/>
                        </div>

                        <div class="d-flex flex-column fv-row mb-8">

                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Email</span>
                            </label>

                            <input type="text" class="form-control form-control-sm bg-light-dark"
                                   value="{{ $one?->no_induk }}" disabled/>
                        </div>
                        <div class="d-flex flex-column fv-row mb-8">

                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span>Status</span>
                            </label>

                            <input type="text" class="form-control form-control-sm bg-light-dark"
                                   value="{{ $one?->status }}" disabled/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
@endsection
