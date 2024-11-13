@extends('admin.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/buttons.dataTables.min.css') }}">
@endsection

@section('title-header')
    <h3>prodi</h3>
@endsection

@section('content')
    <div class="flex-column-fluid">
        <div class="card mb-5 mb-xl-8 border-2 shadow p-3 mb-5 bg-white rounded">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">prodi</span>
                </h3>
                <div class="card-toolbar">

                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <a type="button" class="btn btn-sm btn-primary" href="{{ route('admin.prodi.create') }}">Tambah</a>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="text-muted mb-3">
                    Pada halaman ini digunakan untuk menambah, mengedit, dan detail prodi
                </div>

                <div class="table-responsive">
                    <table id="example"
                           class="table table-row-dashed table-row-gray-500 align-middle gs-0 gy-3 dt-responsive"
                           style="width:100%;">
                        <thead>
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0 ">
                            <th class="w-25px"></th>
                            <th class="min-w-150px">Actions</th>
                            <th class="min-w-150px">Fakultas</th>
                            <th class="min-w-150px">Prodi</th>
                            <th class="min-w-150px">Singkatan</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800 fw-bolder">
                        </tbody>
                    </table>
                </div>
            </div>
            <!--begin::Body-->
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('assets/plugins/custom/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/dataTables.buttons.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/custom/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/js/print.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/responsive.bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $.fn.dataTable.ext.errMode = 'none';
            var table = $('#example').DataTable({
                dom: "lBfrtip",
                stateSave: true,
                stateDuration: -1,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50]
                ],
                columnDefs: [{
                    targets: [0, 1, 2],
                    className: 'noVis'
                }],
                buttons: [{
                    extend: 'colvis',
                    collectionLayout: 'fixed columns',
                    collectionTitle: 'Column visibility control',
                    className: 'btn btn-sm btn-primary rounded',
                    columns: ':not(.noVis)'


                }, {
                    extend: "csv",
                    titleAttr: 'Csv',
                    action: newexportaction,
                    className: 'btn btn-sm btn-primary rounded',
                },
                    {
                        extend: "excel",
                        titleAttr: 'Excel',
                        action: newexportaction,
                        className: 'btn btn-sm btn-primary rounded',
                    },
                ],
                language: {
                    processing: '<p >Tunggu Sebentar...</p>'
                },
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: window.location.href,
                order: [],
                ordering: true,
                columns: [{
                    data: "DT_RowIndex",
                    render: function (data) {
                        if (data != null) {
                            return "";
                        }

                        return data;
                    },
                    orderable: false,
                },
                    {
                        data: "action",
                        render: function (data) {
                            var detail = '{{ route('admin.prodi.show', [':prodi']) }}';
                            var edit = '{{ route('admin.prodi.edit', [':prodi']) }}';
                            var x_edit = "";
                            var x_detail = "";
                            x_detail = `<a data-toggle='tooltip' data-placement='top' title='View' href='${detail.replace(':prodi', data)}' class='btn btn-icon btn-bg-light btn-active-text-primary btn-sm me-1'><span class='bi bi-file-text ' aria-hidden='true'></span></a>`;
                            x_edit = `<a data-toggle='tooltip' data-placement='top' title='Edit' href='${edit.replace(':prodi', data)}' class='btn btn-icon btn-bg-light btn-active-text-primary btn-sm me-1'><span class='bi bi-pencil ' aria-hidden='true'></span> </a>`;
                            x_delete = `<a data-toggle='tooltip' data-placement='top' title='Delete' onclick='deleteConfirmation(${data})' class='btn btn-icon btn-bg-light btn-active-text-primary btn-sm me-1'><span class='bi bi-trash ' aria-hidden='true'></span></a>`;
                            return `${x_detail} ${x_edit} ${x_delete}`;
                        },
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "fakultas",
                        name: "fakultas"
                    },
                    {
                        data: "prodi",
                        name: "prodi"
                    },
                    {
                        data: "singkatan",
                        name: "singkatan"
                    },
                ],
            });
        });

        function deleteConfirmation(prodi) {
            Swal.fire({
                title: 'Apa kamu yakin?',
                text: "Itu akan dihapus secara permanen!",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                allowOutsideClick: false,
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
            }).then((result) => {
                if (result.value) {
                    var destroy = '{{ route('admin.prodi.destroy', [':prodi']) }}';
                    $.ajax({
                        url: destroy.replace(':prodi', prodi),
                        method: 'DELETE',
                        data: {
                            "prodi": prodi,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data == 1 || data == 0) {
                                Swal.fire('Deleted!', 'File telah dihapus.', 'success')
                                window.location.reload();
                            } else {
                                Swal.fire('Permission', 'Tidak memiliki akses hapus!', 'error')
                            }
                        },
                        error: function(error) {
                            Swal.fire('Oops...', 'Ada yang salah dengan penghapusan !', 'error')

                        }
                    });

                }
            });
        }
    </script>
@endsection
