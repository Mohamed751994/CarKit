@extends('admin_dashboard.layout.master')
@section('Page_Title')   العملاء | تعديل   @endsection
@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="breadcrumb d-flex align-items-center justify-content-between">
                <div class="">
                    <a class="text-dark" href="{{route('users.index')}}">العملاء</a>
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
                                                  action="{{route('users.update', $content->id)}}">
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

                }
            });


            $("#validateFormPass").validate({
                rules: {
                    password: {
                        required: true,
                        minlength:'8',
                        maxlength:'25'
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: '#password'
                    }


                },
                messages: {
                    password: {
                        required: "الحقل مطلوب",
                        minlength: "كلمة المرور مكونة علي الأقل 8 أحرف",
                        maxlength: "كلمة المرور مكونة علي الأكثر 25 حرف",
                    },
                    password_confirmation: {
                        required: "الحقل مطلوب",
                          equalTo: "كلمة المرور غير متطابقة",
                    }

                }
            });



        });

    </script>
@endpush
