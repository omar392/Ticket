@extends('admin.layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">{{ __('admin.faqs') }}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="{{ route('adminhome') }}">{{ __('admin.home') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('admin.faqs') }}</li>
                        </ol>
                    </div>
                </div> <!-- end row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <form action="" id="faqs" method="POST" data-parsley-validate>
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="faqsId" id="faqs_id" value="{{ $faqs->id }}"
                                        class="form-control">
                                    <div class="form-group row">
                                        <label for="example-text-input"
                                            class="col-sm-2 col-form-label">{{ __('admin.question_ar') }}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" value="{{ $faqs->question_ar }}" type="text"
                                                name="question_ar" id="example-text-input"
                                                placeholder="{{ __('admin.question_ar') }} " required
                                                parsley-trigger="change">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input"
                                            class="col-sm-2 col-form-label">{{ __('admin.question_en') }}</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" value="{{ $faqs->question_en }}"
                                                name="question_en" id="example-text-input"
                                                placeholder="{{ __('admin.question_en') }}" required
                                                parsley-trigger="change">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input"
                                            class="col-sm-2 col-form-label">{{ __('admin.answer_ar') }}</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="answer_ar" id="" cols="10" rows="10">{!! $faqs->answer_ar !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input"
                                            class="col-sm-2 col-form-label">{{ __('admin.answer_en') }}</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="answer_en" id="" cols="10" rows="10">{!! $faqs->answer_en !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group text-center m-t-20">
                                        <div class="col-12">
                                            <button class="btn btn-primary btn-block btn-lg" name="submit"
                                                type="submit">??????????</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    {{-- <a href="{{url()->previous()}}">
                    <button class="btn btn-primary">{{ __('admin.return') }} <i class="fas fa-backward"></i></button>
                </a> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('submit', '#faqs', function(e) {
                e.preventDefault();
                //  alert('asdasd');
                let id = $('#faqs_id').val();
                var url = '{{ route('faqs.update', ':id') }}';
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    method: "post",
                    data: new FormData(this),
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function(response) {
                        // console.log(response);
                        if (response.status == 'success') {
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                                "showDuration": 500,
                                // "rtl": isRtl
                            }
                            window.location = "{{ route('faqs.index') }}";
                            toastr['info']("{{ __('admin.updatedsuccess') }}");
                        }
                    },

                });
            });

        });
    </script>
@endpush
