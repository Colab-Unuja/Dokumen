@extends('admin.layouts.index')

@section('css')
@endsection

@section('title-header')
    <h3>fakultas</h3>
@endsection

@section('content')
    <div class="flex-column-fluid">
        <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">fakultas</span>
                </h3>

            </div>
            <div class="card-body">
                @include('errors.alert')

                <div class="d-flex flex-column mb-8 fv-row">
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span>fakultas</span>
                    </label>
                    <input type="text" name="fakultas" class="form-control form-control-sm " value="{{$one?->fakultas}}" disabled />
                </div>
                <div class="d-flex flex-column mb-8 fv-row">
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span>singkatan</span>
                    </label>
                    <input type="text" name="singkatan" class="form-control form-control-sm " value="{{$one?->singkatan}}" disabled />
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
@endsection
