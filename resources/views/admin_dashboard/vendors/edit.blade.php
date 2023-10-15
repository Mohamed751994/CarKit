@extends('admin_dashboard.layout.master')
@section('Page_Title')   أصحاب المعارض | تعديل   @endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="breadcrumb d-flex align-items-center justify-content-between">
                <div class="">
                    <a class="text-dark" href="{{route('vendors.index')}}">أصحاب المعارض</a>
                    <span class="mx-2">-</span>
                    <strong class="text-primary">تعديل</strong>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">

                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                                            <div class="d-flex align-items-center">
                                                <div class="tab-icon"><i class='bx bx-home font-18 me-1'></i>
                                                </div>
                                                <div class="tab-title">البيانات الشخصية</div>
                                            </div>
                                        </button>
                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                                            <div class="d-flex align-items-center">
                                                <div class="tab-icon"><i class='bx bx-lock font-18 me-1'></i>
                                                </div>
                                                <div class="tab-title"> تغيير كلمة المرور</div>
                                            </div>
                                        </button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="card-body">
                                            <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                                  action="{{route('vendors.update', $content->id)}}">
                                                @method('put')
                                                @csrf

                                                <div class="col-md-6">
                                                    <label class="form-label">  الأسم  <span class="text-danger">*</span> </label>
                                                    <input type="text" value="{{$content->name}}" name="name" class="form-control" required placeholder="ادخل الأسم ">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">  البريد الإلكتروني <span class="text-danger">*</span> </label>
                                                    <input type="email" value="{{$content->email}}" name="email" class="form-control" required placeholder="ادخل  البريد الإلكتروني">
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label">  رقم الهاتف <span class="text-danger">*</span> </label>
                                                    <input type="number"  value="{{$content->phone}}" min="0" name="phone" class="form-control" required placeholder="ادخل  رقم الهاتف">
                                                </div>


                                                <div class="col-md-6">
                                                    <label class="form-label"> عنوان المعرض <span class="text-danger">*</span> </label>
                                                    <input type="text" value="{{$content->vendor?->address}}" name="address" class="form-control" required placeholder="ادخل عنوان المعرض">
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="uploadAndPreviewImage align-items-center row">
                                                        <div class="col-md-8">
                                                            <label class="form-label">لوجو المعرض <small class="text-danger">(PNG - JPEG - JPG - WEBP - SVG - GIF) ويجب أن لا تتعدي 5 ميجا</small> </label>
                                                            <input type="file" id="image" name="image" class="form-control">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="previewImage text-center">
                                                                @if($content->vendor?->image)
                                                                    <img src="{{$content->vendor?->image}}">
                                                                @else
                                                                    <img src="{{asset('admin_dashboard/assets/images/no_image.png')}}">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label"> ساعات العمل  </label>
                                                    <input type="text" value="{{$content->vendor?->working_hours}}" name="working_hours" class="form-control"  placeholder="ادخل ساعات العمل مثال: من 10 صباحاً الي 10 مساءاً">
                                                </div>


                                                <div class="col-md-6">
                                                    <label class="form-label"> رابط جوجل ماب   </label>
                                                    <input type="url" dir="ltr" value="{{$content->vendor?->google_map}}" name="google_map" class="form-control"  placeholder="https://maps.app.goo.gl/uvHVCsuHVGZ4qhaK7">
                                                </div>




                                                <div class="col-12 mt-3">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">تفعيل الحساب</label>
                                                    <div class="form-check form-switch mt-2">
                                                        <input class="form-check-input customSliderCheckbox" type="checkbox"
                                                               name="status" id="flexSwitchCheckChecked" @if($content->vendor?->status == 1) checked="" value="1" @else value="0" @endif  >
                                                    </div>
                                                </div>


                                                @include('admin_dashboard.inputs.edit_btn')
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <div class="card-body">
                                            <form class="row g-3" id="validateFormPass" method="post" enctype="multipart/form-data"
                                                  action="{{route('users.update.password', $content->id)}}">
                                                @method('put')
                                                @csrf

                                                <div class="col-md-12">
                                                    <label class="form-label">  كلمة المرور <span class="text-danger">*</span> </label>
                                                    <input type="password" id="password"  name="password" class="form-control" required placeholder="ادخل   كلمة المرور">
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label">  تأكيد كلمة المرور <span class="text-danger">*</span> </label>
                                                    <input type="password"  name="password_confirmation" class="form-control" required placeholder="ادخل تأكيد  كلمة المرور">
                                                </div>

                                                @include('admin_dashboard.inputs.edit_btn')
                                            </form>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function () {
            $("#validateForm").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email:true
                    },
                    phone: {
                        required: true,
                        minlength:8,
                        maxlength:25
                    },
                    address: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength:8,
                        maxlength:25
                    },
                    password_confirmation: {
                        required: true,
                        equalTo:"#password"
                    },

                },
                messages: {
                    name: {
                        required: "الحقل مطلوب",
                    },
                    email: {
                        required: "الحقل مطلوب",
                        email:" صيغة البريد الإلكتروني غير صحيحة"
                    },
                    phone: {
                        required: "الحقل مطلوب",
                        minlength:"رقم الهاتف علي الأقل 8 أرقام",
                        maxlength:"رقم الهاتف يجب أن لا يتجاوز 25 رقم"
                    },
                    address: {
                        required: "الحقل مطلوب",
                    },
                    google_map: {
                        url: "ادخل رابط صحيح",
                    },
                    password: {
                        required: "الحقل مطلوب",
                        minlength:"كلمة المرور علي الأقل 8 أحرف",
                        maxlength:"كلمة المرور يجب أن لا تتجاوز 25 حرف"
                    },
                    password_confirmation: {
                        required: "الحقل مطلوب",
                        equalTo:"كلمة المرور غير متطابقة"
                    },


                }
            });
        });

    </script>
    <script>
        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#image").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $('.previewImage img').attr('src', e.target.result);
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            } else {

            }
        });
    </script>
@endpush
