@extends('users.layouts.master')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">{{ __('user.complaints') }}</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('admin.home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('user.complaints') }}</li>
                    </ol>
                </div>
            </div> <!-- end row -->
        </div>
        <!-- end page-title -->

        <br>
        <div class="row align-items-center">

            <div class="text-center">
                <!-- Large modal -->
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal"
                        data-target="#modal-add-complaint" style="margin-right: 20px;margin-left: 20px;"><i
                            class="fas fa-plus-circle" style="padding-inline-end: 5px;"></i>{{ __('admin.add') }}
                        {{ __('user.complaint') }}</button>
                <button type="button" class="btn btn-primary reload float-right mb-3"> <i class="fas fa-sync-alt"></i></button>
            </div>

            <!--  Modal content for the above example -->
            <div class="modal fade modal-add-complaint" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true" id="modal-add-complaint">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myLargeModalLabel">{{ __('admin.add') }}
                                {{ __('user.complaint') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                data-target="#modal-add-complaint">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body" id="modal-add-complaint">
                            <div class="modal-body">
                                <div class="card-body">
                                    <form id="addcomplaint" method="POST" data-parsley-validate>
                                        @csrf
                                        @method('post')

                                        {{-- <div class="form-group row" hidden>
                                            <label
                                                class="col-sm-2 col-form-label">{{ __('admin.department') }}</label>
                                            <div class="col-sm-10" hidden >
                                                <select class="form-control form-control-round" name="user_id"
                                                    id="user_id" required disabled>
                                                    <option value="{{ Auth::user()->id }}" disabled>---</option>
                                                    @foreach ($users as $item)
                                                        <option value="{{ Auth::user()->id }}" disabled>
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="form-group row" hidden>
                                            <label for="example-text-input"
                                                class="col-sm-2 col-form-label">{{ __('user.title') }}</label>
                                            <div class="col-sm-10">
                                                <input class="form-control .inp2" value="{{ Auth::user()->id }}"
                                                    name="user_id" id="example-text-input"
                                                    placeholder="{{ __('user.title') }} ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input"
                                                class="col-sm-2 col-form-label">{{ __('user.title') }}</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" value="{{ old('title') }}" type="text"
                                                    name="title" id="example-text-input"
                                                    placeholder="{{ __('user.title') }} ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input"
                                                class="col-sm-2 col-form-label">{{ __('user.description') }}</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control .inp3" name="description" id="" cols="10" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="example-text-input"
                                                class="col-sm-2 col-form-label">{{ __('user.attached') }}</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" value="{{ old('attached') }}"
                                                    type="file" name="attached[]" id="example-text-input"
                                                    placeholder="{{ __('user.attached') }} " multiple >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label
                                                class="col-sm-2 col-form-label">{{ __('admin.department') }}</label>
                                            <div class="col-sm-10">
                                                <select class="form-control form-control-round .inp1" name="department_id"
                                                    id="department_id">
                                                    <option value="">---</option>
                                                    @foreach ($departments as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
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
                                <th>{{ __('user.complaints') }}</th>
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
    <!-- container-fluid -->

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
                    ajax: "{{ route('complaint.index') }}",

                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'complaint_id',
                            name: 'complaint_id'
                        },
                        {
                            data: 'status',
                            name: 'status'
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
                    ajax: "{{ route('complaint.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'complaint_id',
                            name: 'complaint_id'
                        },
                        {
                            data: 'status',
                            name: 'status'
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
        $('body').on('submit', '#addcomplaint', function(e) {
            e.preventDefault();
            if ($('.inp1').is(':empty') || $('.inp2').is(':empty') || $('.inp3').is(':empty')){
            }
            else {
                $.ajax({
                    url: '{{ route('complaint.store') }}',
                    method: "post",
                    data: new FormData(this),
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {

                        if (response.status == 'success') {
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                                "showDuration": 500,
                                // "rtl": isRtl
                            }
                            toastr['success']("{{ __('admin.addsuccess') }}");
                            $('#datatable').DataTable().ajax.reload();
                            $("#addcomplaint").trigger("reset");
                            $('#modal-add-complaint .close').click();
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
@endpush
