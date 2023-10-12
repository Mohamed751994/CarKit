@extends('admin_dashboard.layout.master')
@section('Page_Title')    ماركات السيارات | تعديل   @endsection
@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="breadcrumb d-flex align-items-center justify-content-between">
                <div class="">
                    <a class="text-dark" href="{{route('brands.index')}}"> ماركات السيارات</a>
                    <span class="mx-2">-</span>
                    <strong class="text-primary">تعديل</strong>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">

                                <div class="card-body">
                                    <form class="row g-3" id="validateForm" method="post" enctype="multipart/form-data"
                                          action="{{route('brands.update', $content->id)}}">
                                        @method('put')
                                        @csrf

                                        <div class="col-md-6">
                                            <label class="form-label">  اسم الماركة  <span class="text-danger">*</span> </label>
                                            <input type="text" name="brand_name" value="{{$content->brand_name}}" class="form-control" required placeholder="ادخل الأسم ">
                                        </div>


                                        <div class="col-12 my-4">
                                            <h5 class="mt-4 mb-3">  الملفات المرفوعة مسبقاً :   </h5>
                                            <div class="row">
                                                @foreach($content->models as $model)
                                                    <div class="col-md-4">
                                                        <div class="box d-flex justify-content-around align-items-center">
                                                            <strong>
                                                                {{$model->model_name}}
                                                            </strong>
                                                            <a data-bs-toggle="modal" data-bs-target="#deleteItem{{$model->id}}" href="javascript:;" class="btn btn-sm btn-danger">حذف</a>
                                                            <div class="modal fade" id="deleteItem{{$model->id}}" tabindex="-1" aria-labelledby="link{{$fileName->id}}" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="link{{$model->id}}">هل أنت متأكد من حذف هذا العنصر ؟</h5>
                                                                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button class="btn btn-outline-default btn-sm me-2" type="button" data-bs-dismiss="modal">لا</button>
                                                                            <a href="{{route('model.destroy',$model->id)}}" class="btn btn-outline-danger btn-sm">نعم</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>


                                        <div class="col-12 mb-5">

                                            <h5 class="mt-4 mb-3"> المودلات الخاصة بهذه الماركة : <span class="text-danger">*</span>  </h5>


                                            <div class="float-end mb-2">
                                                <button type="button" class="btn btn-sm btn-success" id="addNewRow">أضف موديل أخر</button>
                                            </div>
                                            <table class="no-datatable table table-striped table-hover table-responsive table-bordered mb-0">
                                                <thead>
                                                <th>اسم الموديل</th>
                                                <th> حذف</th>
                                                </thead>
                                                <tbody id="lines">
                                                <tr id="tr">
                                                    <td>
                                                        <input class="form-control" name="model_name[]" placeholder="ادخل اسم الموديل" required />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-danger removeRow">
                                                            <i class="lni lni-trash m-0"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>


                                        </div>

                                        @include('admin_dashboard.inputs.edit_btn')
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
