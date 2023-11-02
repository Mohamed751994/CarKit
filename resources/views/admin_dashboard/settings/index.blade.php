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


                    <div class="col-md-6">
                        <label class="form-label">  اسم الموقع  </label>
                        <input type="text" class="form-control" name="website_name" value="{{$content->website_name}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">  رابط الموقع  </label>
                        <input type="url" dir="ltr" class="form-control" name="website_url" value="{{$content->website_url}}" />
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">  لوجو الموقع  </label>
                        <input type="file"  class="form-control" name="website_logo" />
                        <div class="my-3">
                            @if($content->website_logo)
                            <img src="{{$content->website_logo}}" style="width: 200px; height: 200px; object-fit: contain" >
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">  رابط الفيس بوك  </label>
                        <input type="url" dir="ltr" class="form-control" name="facebook" value="{{$content->facebook}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">  رابط لينكدان  </label>
                        <input type="url" dir="ltr" class="form-control" name="linkedin" value="{{$content->linkedin}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">  رابط الأنستاجرام  </label>
                        <input type="url" dir="ltr" class="form-control" name="instagram" value="{{$content->instagram}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">  رابط تويتر  </label>
                        <input type="url" dir="ltr" class="form-control" name="twitter" value="{{$content->twitter}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">  رابط تيك توك  </label>
                        <input type="url" dir="ltr" class="form-control" name="tiktok" value="{{$content->tiktok}}" />
                    </div>


                    <div class="col-md-6">
                        <label class="form-label">  نسبة الخصم علي الحجز (%)  </label>
                        <input type="number" min="0" max="100" class="form-control" name="discount_percentage" value="{{$content->discount_percentage}}" />
                    </div>

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


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function () {
            $("#validateForm").validate({
                rules: {
                    "discount_percentage": {
                        minlength: 0,
                        maxlength: 100,
                    },

                },
                messages: {
                    "discount_percentage": {
                        minlength:"يجب ان يكون أكبر من أو يساوي 0",
                        maxlength:"يجب أن لا يتعدي 100"
                    },
                }
            });
        });
    </script>
@endpush
