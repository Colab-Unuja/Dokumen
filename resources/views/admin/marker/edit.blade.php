@extends('admin.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/select/bootstrap-select.min.css') }}">
@endsection

@section('title-header')
    <h3>marker</h3>
@endsection

@section('content')
    <div class="flex-column-fluid">
        <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">marker</span>
                </h3>

            </div>
            <form action="{{ route('admin.marker.update', ['marker' => $id]) }}" method="post">
                @csrf
                @method('PUT')

                <div class="card-body">
                    @include('errors.alert')
                    <div class="row justify-content-md-center">
                        <div class="col-sm-6 align-content-center">
                            <div class="d-flex flex-column fv-row mb-8">

                                <label class="d-flex align-items-center fs-6 fw-bold required mb-2">
                                    <span>Nama</span>
                                </label>

                                <input type="text" name="marker" class="form-control form-control-sm "
                                       value="{{ $one?->marker }}" required/>
                            </div>

                            <div class="d-flex flex-column fv-row mb-8">

                                <label class="d-flex align-items-center fs-6 fw-bold required mb-2">
                                    <span>Status</span>
                                </label>
                                @php
                                    if ($one?->status == 'active') {
                                        $active = 'checked';
                                        $block = '';
                                    } else {
                                        $active = '';
                                        $block = 'checked';
                                    }
                                @endphp

                                <div class="d-flex fv-row mb-2">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input {{ $active }} class="form-check-input me-3" name="status" type="radio" value="active" id="kt_modal_update_role_option_2">
                                        <label class="form-check-label" for="kt_modal_update_role_option_2">
                                            <div class="fw-bolder text-gray-800">Active</div>
                                        </label>
                                    </div>
                                </div>
                                <div class="d-flex fv-row">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input {{ $block }} class="form-check-input me-3" name="status" type="radio" value="block" id="kt_modal_update_role_option_2">
                                        <label class="form-check-label" for="kt_modal_update_role_option_2">
                                            <div class="fw-bolder text-gray-800">Block</div>
                                        </label>
                                    </div>
                                </div>
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
@endsection
