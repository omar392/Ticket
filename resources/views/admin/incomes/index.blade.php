@extends('admin.layouts.master')

@section('content')
    <div class="content">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">{{ __('admin.incomes') }}</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('adminhome') }}">{{ __('admin.home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('admin.incomes') }}</li>
                    </ol>
                </div>
            </div> <!-- end row -->
            <br>
            <div class="row align-items-center">

                <div class="text-center">
                    &nbsp;&nbsp;
                    <button type="button" class="btn btn-primary reload float-right mb-3"> <i class="fas fa-sync-alt"></i></button>
                </div>

            </div> <!-- end row -->
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">

                        <table id="datatable" class="table table-bordered dt-responsive nowrap yajra-datatable"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('admin.thename') }}</th>
                                    <th>{{ __('admin.user_type') }}</th>
                                    <th>{{ __('admin.thedepart') }}</th>
                                    <th>{{ __('admin.AWN') }}</th>
                                    <th>{{ __('admin.status') }}</th>
                                    <th>{{ __('admin.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
    </div>
@endsection
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(function() {
            var locale = '{{ config('app.locale') }}';
            if (locale == 'ar') {
                var table = $('.yajra-datatable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Arabic.json"
                    },
                    processing: true,
                    "language": {
                    "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:#E6554F;"></i>'
                 },
                    serverSide: true,
                    ajax: "{{ route('incomes.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'user_id',
                            name: 'user_id'
                        },
                        {
                            data: 'user_type',
                            name: 'user_type'
                        },
                        {
                            data: 'department_id',
                            name: 'department_id'
                        },
                        {
                            data: 'complaint_id',
                            name: 'complaint_id'
                        },

                        {
                            data: 'status',
                            name: 'status',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });
            } else {
                var table = $('.yajra-datatable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/English.json"
                    },
                    processing: true,
                    "language": {
                    "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:#E6554F;"></i>'
                 },
                    serverSide: true,
                    ajax: "{{ route('incomes.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'user_id',
                            name: 'user_id'
                        },
                        {
                            data: 'user_type',
                            name: 'user_type'
                        },
                        {
                            data: 'department_id',
                            name: 'department_id'
                        },
                        {
                            data: 'complaint_id',
                            name: 'complaint_id'
                        },

                        {
                            data: 'status',
                            name: 'status',
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });
            }
            $(".reload").click(function() {
                table.ajax.reload(null, false);
            });
        });
    </script>
    {{-- <script>
        $('body').on('click', '#check', function() {
            //e.preventDefault();
            var active = $(this).prop('checked') == true ? 1 : 0;
            var income_id = $(this).data('id');
            // alert(income_id);
            $.ajax({
                url: '{{ route('incomes.status') }}',
                type: 'GET',
                data: {
                    'active': active,
                    'income_id': income_id
                },
                success: function(response) {
                    if (response.status == 'success') {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "showDuration": 500,

                        }
                        toastr['success']("@lang('admin.statuschange')");
                    }
                }
            });
        });
    </script> --}}
    <script>
        $('body').on('submit', '#sa-params', function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                method: "delete",
                data: {
                    _token: '{{ csrf_token() }}',
                },

                success: function(response) {
                    if (response.status == 'success') {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "showDuration": 500,
                            // "rtl": isRtl
                        }
                        toastr['error']("{{ __('admin.deletedsuccess') }}");
                    }
                    $('#datatable').DataTable().ajax.reload();
                }
            });
        })
    </script>
@endpush
