@extends('admin.layouts.master')

@section('content')
    <div class="content">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">{{ __('admin.users') }}</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('adminhome') }}">{{ __('admin.home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('admin.users') }}</li>
                    </ol>
                </div>
            </div> <!-- end row -->
            <br>
            <div class="row align-items-center">

                <div class="text-center">
                    @if (Auth::guard('admin')->user()->hasPermission('users-create'))
                        <!-- Large modal -->
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal"
                            data-target="#modal-add-user" style="margin-right: 20px;margin-left: 20px;"><i
                                class="fas fa-plus-circle" style="padding-inline-end: 5px;"></i>{{ __('admin.add') }}
                            {{ __('admin.user') }}</button>
                    @endif
                    <button type="button" class="btn btn-primary reload float-right mb-3"> <i
                            class="fas fa-sync-alt"></i></button>
                </div>

                <!--  Modal content for the above example -->
                <div class="modal fade modal-add-user" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                    aria-hidden="true" id="modal-add-user">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="myLargeModalLabel">{{ __('admin.add') }}
                                    {{ __('admin.users') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    data-target="#modal-add-user">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body" id="modal-add-user">
                                <div class="modal-body">
                                    <div class="card-body">
                                        <form id="adduser" method="POST" data-parsley-validate>
                                            @csrf
                                            @method('post')

                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                    class="col-sm-2 col-form-label">{{ __('admin.name') }}</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control .inp1" value="{{ old('name') }}"
                                                        type="text" name="name" id="example-text-input"
                                                        placeholder="{{ __('admin.name') }} ">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                    class="col-sm-2 col-form-label">{{ __('admin.phone') }}</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control .inp2" value="{{ old('phone') }}"
                                                        type="number" name="phone" id="example-text-input"
                                                        placeholder="{{ __('admin.phone') }} ">
                                                </div>
                                            </div>
                                            {{-- <div class="form-group row">
                                                <label
                                                    class="col-sm-2 col-form-label">{{ __('admin.department') }}</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control form-control-round" name="department_id"
                                                        id="department_id" required>
                                                        <option value="">---</option>
                                                        @foreach ($departments as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> --}}
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">{{ __('admin.user_type') }}</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control form-control-round .inp3" name="user_type"
                                                        id="user_type">
                                                        <option value="customer">---</option>
                                                        <option value="employee">{{ __('admin.employee') }}
                                                        </option>
                                                        <option value="customer">{{ __('admin.customer') }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                    class="col-sm-2 col-form-label">{{ __('admin.email') }}</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control .inp4" name="email" type="email"
                                                        id="example-text-input" placeholder="{{ __('admin.email') }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-text-input"
                                                    class="col-sm-2 col-form-label">{{ __('admin.password') }}</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control .inp5" name="password" type="password"
                                                        id="example-text-input" placeholder="{{ __('admin.password') }}">
                                                </div>
                                            </div>


                                            <div class="form-group text-center m-t-20">
                                                <div class="col-12">
                                                    <button class="btn btn-primary btn-block btn-lg" name="submit"
                                                        type="submit">{{ __('admin.add') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
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
                                    <th>{{ __('admin.name') }}</th>
                                    <th>{{ __('admin.phone') }}</th>
                                    <th>{{ __('admin.email') }}</th>
                                    <th>{{ __('admin.user_type') }}</th>
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
                    ajax: "{{ route('users.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'user_type',
                            name: 'user_type'
                        },
                        {
                            data: 'active',
                            name: 'active',
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
                    ajax: "{{ route('users.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'user_type',
                            name: 'user_type'
                        },
                        {
                            data: 'active',
                            name: 'active',
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
        <script>
        $('body').on('click', '#check', function() {
            //e.preventDefault();
            var active = $(this).prop('checked') == true ? 1 : 0;
            var user_id = $(this).data('id');
            // alert(user_id);
            $.ajax({
                url: '{{ route('users.status') }}',
                type: 'GET',
                data: {
                    'active': active,
                    'user_id': user_id
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
    </script>
    <script>
        $('body').on('submit', '#adduser', function(e) {
            e.preventDefault();
            if ($('.inp1').is(':empty') || $('.inp2').is(':empty') || $('.inp3').is(':empty') || $('.inp4').is(
                    ':empty') || $('.inp5').is(':empty')) {} else {
                $.ajax({
                    url: '{{ route('users.store') }}',
                    method: "post",
                    data: new FormData(this),
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        if (response.status == 'success') {
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                                "showDuration": 500,
                                // "rtl": isRtl
                            }
                            toastr['success']("{{ __('admin.addsuccess') }}");
                            $('#datatable').DataTable().ajax.reload();
                            $("#adduser").trigger("reset");
                            $('#modal-add-user .close').click();
                            $(".modal-backdrop").remove();
                        } else if (response.status == 'fails') {


                            $.each(response.errors, function(index, value) {
                                toastr['error'](value);
                            });
                        }

                    }
                });
            }
        });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

                        $('#datatable').DataTable().ajax.reload();
                    }

                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        })
        $('body').on('click', '.delete', function(e) {
            var that = $(this)
            e.preventDefault();
            Swal.fire({
                title: "{{ __('admin.wantdelete') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{ __('admin.yes') }}",
                cancelButtonText: "{{ __('admin.cancel') }}",
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.isConfirmed) {
                    that.closest('form').submit();
                    Swal.fire({
                        icon: 'success',
                        title: "{{ __('admin.deletedsuccess') }}",
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                }
            });

        });
    </script>
@endpush
