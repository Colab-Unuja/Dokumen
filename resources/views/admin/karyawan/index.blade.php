@extends('admin.layouts.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/buttons.dataTables.min.css') }}">
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
                <div class="card-toolbar">

                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <a type="button" class="btn btn-sm btn-primary" href="{{ route('admin.karyawan.create') }}">Tambah karyawan</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="text-muted mb-3">
                    Pada halaman ini digunakan untuk menambah, mengedit, dan detail karyawan
                </div>
                <div class="notice d-flex bg-light-primary border-primary mb-3 rounded border border-dashed p-3">
                    <div class="d-flex flex-stack">
                        <div>
                            <div class="fs-12 text-gray-700">Berikut karyawan data.
                            </div>
                            <div class="fs-12 text-gray-700">
                                <div style="color: #d80000; font-weight: 500;">Data karyawan adalah blok</div>
                                <div style="color: #008c46 ; font-weight: 500;">Data karyawan adalah aktif</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example"
                           class="table table-row-dashed table-row-gray-500 align-middle gs-0 gy-3 dt-responsive"
                           style="width:100%;">
                        <thead>
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0 ">
                            <th class="w-25px"></th>
                            <th class="w-25px">
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input bg-primary" type="checkbox" data-kt-check="true"  data-kt-check-target=".widget-13-check" name="select_all"/>
                                </div>
                            </th>
                            <th class="min-w-150px">Actions</th>
                            <th class="min-w-150px">Nama</th>
                            <th class="min-w-150px">Email</th>
                            <th class="min-w-150px">Unit</th>
                            <th class="min-w-150px">Status</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800 fw-bolder">
                        </tbody>
                    </table>

                </div>
                <br>
                <div class="text-center">
                    <button class="btn btn-sm btn-primary" id="active">Active</button>
                    <button class="btn btn-sm btn-danger" id="block">Block</button>
                </div>
                <br>
            </div>
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
        function updateDataTableSelectAllCtrl(table) {
            var $table = table.table().node();
            var $chkbox_all = $('tbody input[type="checkbox"]', $table);
            var $chkbox_checked = $('tbody input[type="checkbox"]:checked', $table);
            var chkbox_select_all = $('thead input[name="select_all"]', $table).get(0);

            // If none of the checkboxes are checked
            if ($chkbox_checked.length === 0) {
                chkbox_select_all.checked = false;
                if ('indeterminate' in chkbox_select_all) {
                    chkbox_select_all.indeterminate = false;
                }

                // If all of the checkboxes are checked
            } else if ($chkbox_checked.length === $chkbox_all.length) {
                chkbox_select_all.checked = true;
                if ('indeterminate' in chkbox_select_all) {
                    chkbox_select_all.indeterminate = false;
                }

                // If some of the checkboxes are checked
            } else {
                chkbox_select_all.checked = true;
                if ('indeterminate' in chkbox_select_all) {
                    chkbox_select_all.indeterminate = true;
                }
            }
        }

        $(document).ready(function () {
            var rows_selected = [];
            $.fn.dataTable.ext.errMode = 'none';
            var table = $('#example').DataTable({
                dom: "lBfrtip",
                stateSave: true,
                stateDuration: -1,
                stateSave: true,
                stateDuration: -1,
                lengthuser: [
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
                rowCallback: function (row, data, dataIndex) {
                    // Get row ID
                    if (data["status"] == "block") {
                        $("td", row).css("color", "#d80000");
                    } else if (data["status"] == "active") {
                        $("td", row).css("color", "#008c46");
                    }


                    var rowId = data['id_user'];
                    // If row ID is in the list of selected row IDs
                    if ($.inArray(rowId, rows_selected) !== -1) {
                        $(row).find('input[type="checkbox"]').prop('checked', true);
                        $(row).addClass('selected');
                    }
                },
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
                        data: "cek",
                        render: function (data) {
                            return `<div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input widget-13-check bg-primary" type="checkbox" name="check[]"
                                    value="${data}" />
                            </div>`;
                        },
                        orderable: false,
                    },
                    {
                        data: "action",
                        render: function (data) {
                            var detail = '{{ route('admin.karyawan.show', [':karyawan']) }}';
                            var edit = '{{ route('admin.karyawan.edit', [':karyawan']) }}';
                            var x_edit = "";
                            var x_detail = "";
                            var x_delete = "";

                            x_detail =
                                `<a data-toggle='tooltip' data-placement='top' title='View' href='${detail.replace(':karyawan', data)}' class='btn btn-icon btn-bg-light btn-active-text-primary btn-sm me-1'><span class='bi bi-file-text ' aria-hidden='true'></span></a>`;

                            x_edit =
                                `<a data-toggle='tooltip' data-placement='top' title='Edit' href='${edit.replace(':karyawan', data)}' class='btn btn-icon btn-bg-light btn-active-text-primary btn-sm me-1'><span class='bi bi-pencil ' aria-hidden='true'></span> </a>`;

                            x_delete =
                                `<a data-toggle='tooltip' data-placement='top' title='Delete' onclick='deleteConfirmation(${data})' class='btn btn-icon btn-bg-light btn-active-text-primary btn-sm me-1'><span class='bi bi-trash ' aria-hidden='true'></span></a>`;

                            return `${x_detail} ${x_edit} ${x_delete}`;
                        },
                        orderable: true,
                        searchable: true,
                    },
                    {
                        data: "nama",
                        name: "nama"
                    },
                    {
                        data: "no_induk",
                        name: "no_induk"
                    },
                    {
                        data: "unit",
                        name: "unit"
                    },
                    {
                        data: "status",
                        name: "status"
                    },

                ],
            });
            $('#example tbody').on('click', 'input[type="checkbox"]', function (e) {
                var $row = $(this).closest('tr');
                var data = table.row($row).data();
                var rowId = data['id_user'];
                var index = $.inArray(rowId, rows_selected);
                if (this.checked && index === -1) {
                    rows_selected.push(rowId);
                } else if (!this.checked && index !== -1) {
                    rows_selected.splice(index, 1);
                }

                if (this.checked) {
                    $row.addClass('selected');
                } else {
                    $row.removeClass('selected');
                }
                updateDataTableSelectAllCtrl(table);
                e.stopPropagation();
            });

            // Handle click on table cells with checkboxes
            $('#example').on('click', 'tbody td, thead th:first-child', function (e) {
                $(this).parent().find('input[type="checkbox"]').trigger('click');
            });

            // Handle click on "Select all" control
            $('thead input[name="select_all"]', table.table().container()).on('click', function (e) {
                if (this.checked) {
                    $('#example tbody input[type="checkbox"]:not(:checked)').trigger('click');
                } else {
                    $('#example tbody input[type="checkbox"]:checked').trigger('click');
                }

                // Prevent click event from propagating to parent
                e.stopPropagation();
            });

            // Handle table draw event
            table.on('draw', function () {
                // Update state of "Select all" control
                updateDataTableSelectAllCtrl(table);
            });

            $("#active").click(function () {
                if (rows_selected.length > 0) {
                    $("#active").prop("disabled", true);
                    var url = '{{ route('admin.karyawan.edit.all') }}';
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id_user": rows_selected,
                            "status": "active",

                        },

                        async: false,
                        success: function (data) {
                            Swal.fire({
                                title: 'user',
                                text: "Saved successfully",
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'ok',
                                allowOutsideClick: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    return location.reload(true);
                                }
                            })
                        },
                        error: function (error) {
                            $("#active").prop("disabled", false);
                            Swal.fire('user', 'failed to approvel', 'error')
                        }
                    })
                }
            });
            $("#block").click(function () {
                if (rows_selected.length > 0) {
                    $("#block").prop("disabled", true);
                    var url = '{{ route('admin.karyawan.edit.all') }}';
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id_user": rows_selected,
                            "status": "block",

                        },

                        async: false,
                        success: function (data) {
                            Swal.fire({
                                title: 'user',
                                text: "Saved successfully",
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'ok',
                                allowOutsideClick: false,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    return location.reload(true);
                                }
                            })
                        },
                        error: function (error) {
                            $("#block").prop("disabled", false);
                            Swal.fire('user', 'failed to approvel', 'error')
                        }
                    })
                }
            });
        });

        function deleteConfirmation(user) {
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
                    var destroy = '{{ route('admin.karyawan.destroy', [':karyawan']) }}';
                    $.ajax({
                        url: destroy.replace(':karyawan', user),
                        method: 'DELETE',
                        data: {
                            "user": user,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function (data) {
                            Swal.fire('Deleted!', 'Data telah dihapus.', 'success')
                            window.location.reload();
                        },
                        error: function (error) {
                            Swal.fire('Oops...', 'Ada yang salah dengan penghapusan !', 'error')

                        }
                    });

                }
            });
        }
    </script>
@endsection
