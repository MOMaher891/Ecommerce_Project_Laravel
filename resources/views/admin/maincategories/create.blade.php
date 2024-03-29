@extends('layouts.admin')
@section('title', 'إضافه قسم رئيسى')
@section('content')
    <style>
        .text-danger {
            opacity: 1;
            transition: opacity 0.3s ease;
        }
    </style>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.main_Categories') }}"> الاقسام الرئيسية
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">إضافة قسم رئيسي
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> إضافة قسم رئيسي </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" id="create_main_category"
                                            action="{{ route('admin.main_Categories.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group w-25">
                                                <label> صوره القسم </label>
                                                <label id="projectinput7" class="file center-block">
                                                </label>
                                                <input type="file" id="file" name="photo" class="form-control">
                                                <span class="file-custom"></span>
                                                @error('photo')
                                                    <span class="text-danger ">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات القسم </h4>

                                                @if (getActiveLanguages()->count() > 0)
                                                    @foreach (getActiveLanguages() as $index => $lang)
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> اسم القسم -
                                                                        {{ __('messages.' . $lang->abbr) }} </label>
                                                                    <input type="text"
                                                                        value="{{ old("category[ $index][name]") }}"
                                                                        id="name" class="form-control" placeholder="  "
                                                                        name="category[{{ $index }}][name]">
                                                                    @error("category.$index.name")
                                                                        <span class="text-danger "> هذا
                                                                            الحقل مطلوب</span>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6 hidden">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> أختصار اللغة
                                                                        {{ __('messages.' . $lang->abbr) }} </label>
                                                                    <input type="text" id="abbr"
                                                                        class="form-control" placeholder=""
                                                                        value="{{ $lang->abbr }}"
                                                                        name="category[{{ $index }}][abbr]">

                                                                    @error("category.$index.abbr")
                                                                        <span class="text-danger"> هذا الحقل مطلوب</span>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mt-1">
                                                                    <input type="checkbox" value="1"
                                                                        name="category[{{ $index }}][active]"
                                                                        id="switcheryColor4" class="switchery"
                                                                        data-color="success" checked />
                                                                    <label for="switcheryColor4"
                                                                        class="card-title ml-1">الحالة
                                                                        {{ __('messages.' . $lang->abbr) }} </label>

                                                                    @error("category.$index.active")
                                                                        <span class="text-danger"> </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>


                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
                                                </button>
                                                <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

    {{-- JQuery --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> --}}
    <script>
        let error_msg = document.querySelectorAll('.text-danger');
        setTimeout(() => {
            error_msg.forEach(e => {
                // Set the opacity to 0 to start the fade-out effect
                e.style.opacity = 0;

                // After a short delay, set the element's display to "none" to fully hide it
                setTimeout(function() {
                    e.style.display = "none";
                }, 200); // 300 milliseconds, which is the same as the CSS transition duration
            });

        }, 4000);
    </script>
@endsection
