@extends('admin.layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
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
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <form action="" id="users" method="POST" data-parsley-validate>
                                    @csrf
                                    @method('put')

                                    <input type="hidden" name="userId" id="user_id" value="{{ $user->id }}"
                                        class="form-control">

                                        {{-- <div class="form-group row">
                                            <label
                                                class="col-sm-2 col-form-label">{{ __('admin.user_type') }}</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="user_type" disabled>
                                                    <option value="employee" {{old('user_type',$user->user_type) == 'employee' ? 'selected': ''}} >{{ __('admin.employee') }}</option>
                                                    <option value="customer" {{old('user_type',$user->user_type) == 'customer' ? 'selected': ''}}>{{ __('admin.customer') }}</option>
                                                </select>
                                                <span class="text-danger" id="user_typeError"></span>
                                            </div>
                                        </div> --}}
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">@lang('admin.user_type')</label>
                                            <div class="col-sm-10">
                                                <select class="form-control form-control-round" name="user_type" id="user_type">
                                                    {{-- <option value="{{ $user->user_type }}">{{$user->user_type}}</option> --}}
                                                    <option value="employee" {{old('user_type',$user->user_type) == 'employee' ? 'selected': ''}} >{{ __('admin.employee') }}</option>
                                                    <option value="customer" {{old('user_type',$user->user_type) == 'customer' ? 'selected': ''}}>{{ __('admin.customer') }}</option>
                                                </select>
                                                <span class="text-danger" id="user_typeError"></span>
                                            </div>
                                        </div>

                                    <div class="form-group row">
                                        <label for="example-text-input"
                                            class="col-sm-2 col-form-label">{{ __('admin.name') }}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="name" id="example-text-input"
                                                placeholder="{{ __('admin.name') }}" value="{{ $user->name }}">
                                                <span class="text-danger" id="nameError"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input"
                                            class="col-sm-2 col-form-label">{{ __('admin.phone') }}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="number" name="phone" id="example-text-input"
                                                placeholder="{{ __('admin.phone') }}" value="{{ $user->phone }}"
                                                >
                                                <span class="text-danger" id="phoneError"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input"
                                            class="col-sm-2 col-form-label">{{ __('admin.email') }}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="email" name="email" id="example-text-input"
                                                placeholder="{{ __('admin.email') }}" value="{{ $user->email }}"
                                                >
                                                <span class="text-danger" id="emailError"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input"
                                            class="col-sm-2 col-form-label">{{ __('admin.password') }}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" name="password" type="password"
                                                id="example-text-input" placeholder="{{ __('admin.password') }}"
                                                >
                                                <span class="text-danger" id="passwordError"></span>
                                        </div>
                                    </div>
                                    <div class="form-group text-center m-t-20">
                                        <div class="col-12">
                                            <button class="btn btn-primary btn-block btn-lg" name="submit"
                                                type="submit">{{ __('admin.edit') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
    $(function () {
        let name = $("input[name=name]").val();
        let email = $("input[name=email]").val();
        let phone = $("input[name=phone]").val();
        let password = $("input[name=password]").val();
        let user_type = $("input[name=user_type]").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('submit','#users',function (e) {
                e.preventDefault();
                //  alert('asdasd');
                 let id = $('#user_id').val();
                 var url = '{{ route('users.update', ':id') }}';
                 url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    method: "post",
                    data: new FormData(this),
                    dataType: 'json',
                    cache       : false,
                    contentType : false,
                    processData : false,

                    success: function (response) {
                        // console.log(response);
                        if(response.status == 'success'){
                            toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "showDuration": 500,
                            // "rtl": isRtl
                        }
                        window.location = "{{ route('users.index') }}";
                        toastr['info']("{{ __('admin.updatedsuccess') }}");
                        }
                    },
                    error:function (response) {
                        $('#nameError').text(response.responseJSON.errors.name);
                        $('#phoneError').text(response.responseJSON.errors.phone);
                        $('#emailError').text(response.responseJSON.errors.email);
                        $('#passwordError').text(response.responseJSON.errors.password);
                        $('#user_typeError').text(response.responseJSON.errors.user_type);
                    }
                });
            });
        });
</script>
@endpush
