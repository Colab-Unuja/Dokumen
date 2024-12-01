@extends('admin.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/select/bootstrap-select.min.css') }}">
@endsection

@section('title-header')
    <h3>surat</h3>
@endsection

@section('content')
    <div class="flex-column-fluid">
        <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">surat</span>
                </h3>
            </div>
            <form action="{{ route('admin.surat.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    @include('errors.alert')
                    <div class="row justify-content-md-center">
                        <div class="col-sm-10 align-content-center">
                            <div class="d-flex flex-column fv-row mb-8">
                                <label class="d-flex align-items-center fs-6 fw-bold required mb-2">
                                    <span>Nama</span>
                                </label>
                                <input type="text" name="nama_template" class="form-control form-control-sm " value="{{ old('nama_template') }}" required />
                            </div>
                            <div class="d-flex flex-column fv-row mb-8">
                                <label class="d-flex align-items-center fs-6 fw-bold required mb-2">
                                    <span>versi</span>
                                </label>
                                <input type="text" name="versi" class="form-control form-control-sm " value="{{ old('versi') }}" required />
                            </div>
                            <div class="d-flex flex-column fv-row mb-8">
                                <label class="d-flex align-items-center fs-6 fw-bold required mb-2">
                                    <span>file</span>
                                </label>
                                <input type="file" name="file" class="form-control form-control-sm " accept=".doc, .docx" required />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                    <span>Unit</span>
                                </label>
                                <select class="selectpicker form-control form-control-sm form-select-solid " name="id_unit"
                                    id="id_unit" data-live-search="true" required>
                                    @foreach ($unit as $item)
                                        <option value="{{ $item->id_unit }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="clonedInput" id="removeId1">
                                <div class="row" id="clonedInput">
                                    <div class="col-md-5">
                                        <div class="d-flex flex-column mb-2 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                                <span>Kunci</span>
                                            </label>
                                            <input type="text" name="key[]" class="form-control form-control-sm "
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex flex-column mb-2 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                                <span>Data</span>
                                            </label>
                                            <input type="text" name="value[]" class="form-control form-control-sm "
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button id="add" type="button" class="btn btn-sm btn-primary w-100 mt-8">
                                            <span class="indicator-label">Tambah</span>
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" name="count[]" value="1">
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
        var i = 1;

        $('#add').click(function() {
            i++;
            $('#clonedInput').append(`
            <div class="clonedInput" id="removeId${i}">
                <div class="row" id="clonedInput">
                    <div class="col-md-5">
                        <div class="d-flex flex-column mb-2 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                <span>Kunci</span>
                            </label>
                            <input type="text" name="key[]" class="form-control form-control-sm "
                                required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-column mb-2 fv-row">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2 required">
                                <span>Data</span>
                            </label>
                            <input type="text" name="value[]" class="form-control form-control-sm "
                                required />
                        </div>
                    </div>
                    <div class="col-md-1">
                      <button type="button" name="remove" id="${i}" class="btn-sm btn-danger btn_remove mt-8 w-100 text-white">Delete</button>
                      <input type="hidden" name="count[]" value="${i}">
                    </div>
                </div>
            </div>`);
            $('.selectpicker').selectpicker('refresh');

        });


        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#removeId' + button_id + '').remove();
        });

        window.onbeforeunload = function() {
            $("button[type=submit]").prop("disabled", "disabled");
        }
        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 2000);
    </script>
@endsection
