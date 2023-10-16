@extends('admin_dashboard.layout.master')
@section('Page_Title')  الإعدادات @endsection

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>  الإعدادات </h5>
            </div>

            <form class="row g-3 mt-5" id="validateForm" method="post" enctype="multipart/form-data"
                      action="{{route('settings.update', $content->id)}}">
                    @method('put')
                    @csrf

                    <div class="col-md-12">
                        <label class="form-label">  معلومات التواصل  </label>
                        <textarea class="form-control ckeditor" name="contacts">{!! $content->contacts !!}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">  الشروط والأحكام  </label>
                        <textarea class="form-control ckeditor" name="terms">{!! $content->terms !!}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">  الخصوصية والسياسة  </label>
                        <textarea class="form-control ckeditor" name="policy">{!! $content->policy !!}</textarea>
                    </div>



                    @include('admin_dashboard.inputs.edit_btn')
                </form>

        </div>
    </div>


@endsection

