@extends('admin_dashboard.layout.master')
@section('Page_Title')   العملاء | إضافة   @endsection


@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="breadcrumb">
                <a class="text-dark" href="{{route('admin.dashboard')}}">لوحة التحكم</a>
                <span class="mx-2">\</span>
                <a class="text-dark" href="{{route('users.index')}}">العملاء</a>
                <span class="mx-2">\</span>
                <strong class="text-primary">إضافة</strong>
            </div>
            <div class="card">
                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>  العملاء | إضافة عميل جديد </h5>
                        <h5 class="mb-0">
                            <a class="btn btn-danger btn-sm" href="{{route('users.index')}}">عودة</a>
                        </h5>
                    </div>
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">
                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                    action="{{route('users.store')}}">
                                        @csrf
                                        <div class="col-md-6">
                                            <label class="form-label">  الأسم  <span class="text-danger">*</span> </label>
                                            <input type="text" name="name" class="form-control" required placeholder="ادخل الأسم ">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">  البريد الإلكتروني <span class="text-danger">*</span> </label>
                                            <input type="email" name="email" class="form-control" required placeholder="ادخل  البريد الإلكتروني">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">  رقم الهاتف <span class="text-danger">*</span> </label>
                                            <input type="number" min="0" name="phone" class="form-control" required placeholder="ادخل  رقم الهاتف">
                                        </div>


                                        <div class="col-md-12">
                                            <label class="form-label">  كلمة المرور <span class="text-danger">*</span> </label>
                                            <input type="text" id="password" name="password" class="form-control" required placeholder="ادخل  كلمة المرور">
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label">  تأكيد كلمة المرور <span class="text-danger">*</span> </label>
                                            <input type="text"  name="password_confirmation" class="form-control" required placeholder="ادخل تأكيد كلمة المرور">
                                        </div>

                                        @include('admin_dashboard.inputs.add_btn')
                                    </form>
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
@endpush
