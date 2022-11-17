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
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body mt-5">
                                <section id="cd-timeline" class="cd-container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="main-timeline">
                                                <div class="timeline">
                                                    <span class="timeline-icon"></span>
                                                    <span
                                                        class="year">{{ $complaint->created_at->format('d-m-Y') }}</span>
                                                    <div class="timeline-content">
                                                        <h5 class="title">{{ __('user.complaint') }} -
                                                            {{ $complaint->id }}</h5> -
                                                        <h5 class="title">-{{ __('admin.department') }}
                                                            {{ $complaint->department->name }}</h5><br>
                                                        <h3 class="title">{{ $complaint->title }}</h3>
                                                        <p class="description text-muted">
                                                            {!! $complaint->description !!}
                                                        </p>
                                                        <h3 class="title">{{ __('user.attached') }}</h3>
                                                        @php
                                                            $attaches = explode('|', $complaint->attached);
                                                        @endphp
                                                        @foreach ($attaches as $key => $item)
                                                            <a href="{{ url('files/' . $item) }}"
                                                                download="">{{ __('user.attached') }}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @foreach ($replies as $item)
                                                    <div class="timeline">
                                                        <span class="timeline-icon"></span>
                                                        <span
                                                            class="year">{{ $item->created_at->format('d-m-y') }}</span>
                                                        <div class="timeline-content">
                                                            <h3 class="title">{{ $item->writer }}</h3> <br>
                                                            <h3 class="title">{{ $item->complaint->title }}</h3>
                                                            <p class="description text-muted">
                                                                {!! $item->description !!}
                                                            </p>
                                                            @php
                                                                $attaches = explode('|', $item->attached);
                                                            @endphp
                                                            @foreach ($attaches as $key => $items)
                                                                <a href="{{ url('files/' . $items) }}"
                                                                    download="">{{ __('user.attached') }}</a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                                {{-- <div class="mt-5">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light">{{ __('user.reply') }}</button>
                                                </div> --}}
                                                <div class="text-center">
                                                    <!-- Large modal -->
                                                    <button type="button" class="btn btn-primary waves-effect waves-light"
                                                        data-toggle="modal" data-target="#modal-add-reply"
                                                        style="margin-right: 20px;margin-left: 20px;"><i
                                                            class="fas fa-plus-circle"
                                                            style="padding-inline-end: 5px;"></i>{{ __('admin.add') }}
                                                        {{ __('user.reply') }}</button>
                                                </div>
                                                <!--  Modal content for the above example -->
                                                <div class="modal fade modal-add-reply" tabindex="-1" role="dialog"
                                                    aria-labelledby="myLargeModalLabel" aria-hidden="true"
                                                    id="modal-add-reply">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title mt-0" id="myLargeModalLabel">
                                                                    {{ __('admin.add') }}
                                                                    {{ __('user.complaint') }}</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close"
                                                                    data-target="#modal-add-reply">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body" id="modal-add-reply">
                                                                <div class="modal-body">
                                                                    <div class="card-body">
                                                                        <form id="addreply" method="POST"
                                                                            data-parsley-validate>
                                                                            @csrf
                                                                            @method('post')

                                                                            <div class="form-group row" hidden>
                                                                                <label for="example-text-input"
                                                                                    class="col-sm-2 col-form-label">{{ __('user.title') }}</label>
                                                                                <div class="col-sm-10">
                                                                                    <input class="form-control"
                                                                                        value="{{ Auth::user()->name }}"
                                                                                        name="writer"
                                                                                        id="example-text-input"
                                                                                        placeholder="{{ __('user.title') }} "
                                                                                        required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row" hidden>
                                                                                <label for="example-text-input"
                                                                                    class="col-sm-2 col-form-label">{{ __('user.title') }}</label>
                                                                                <div class="col-sm-10">
                                                                                    <input class="form-control"
                                                                                        value="{{ $complaint->id }}"
                                                                                        name="complaint_id"
                                                                                        id="example-text-input"
                                                                                        placeholder="{{ __('user.title') }} "
                                                                                        required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="example-text-input"
                                                                                    class="col-sm-2 col-form-label">{{ __('user.title') }}</label>
                                                                                <div class="col-sm-10">
                                                                                    <input class="form-control .inp1"
                                                                                        value="{{ old('title') }}"
                                                                                        type="text" name="title"
                                                                                        id="example-text-input"
                                                                                        placeholder="{{ __('user.title') }} "
                                                                                        >
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="example-text-input"
                                                                                    class="col-sm-2 col-form-label">{{ __('user.description') }}</label>
                                                                                <div class="col-sm-10">
                                                                                    <textarea class="form-control .inp2" name="description" id="" cols="10" rows="10"></textarea>
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
                                                                            <div class="form-group text-center m-t-20">
                                                                                <div class="col-12">
                                                                                    <button
                                                                                        class="btn btn-primary btn-block btn-lg"
                                                                                        name="submit"
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
                                            </div>
                                        </div>
                                    </div>
                                </section>

                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- end row -->
        </div>
    </div>
    <!-- container-fluid -->

    </div>
@endsection
@push('js')

<script>
    $('body').on('submit', '#addreply', function(e) {
        e.preventDefault();
        if ($('.inp1').is(':empty') || $('.inp2').is(':empty')){
        }
        else {
            $.ajax({
                url: '{{ route('complaint.reply') }}',
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
                        $("#addreply").trigger("reset");
                        $('#modal-add-reply .close').click();
                        $(".modal-backdrop").remove();
                        window.location.replace(window.location.pathname + window.location.search + window
                    .location.hash);
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
