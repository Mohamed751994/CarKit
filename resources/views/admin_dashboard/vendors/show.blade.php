@extends('admin_dashboard.layout.master')
@section('Page_Title')
    السيارات والحجوزات الخاصة بالتاجر {{$content->vendor?->name}}
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="breadcrumb d-flex align-items-center justify-content-between">
                <div class="">
                    <a class="text-dark" href="{{route('vendors.index')}}">أصحاب المعارض</a>
                    <span class="mx-2">-</span>
                    <strong class="text-primary">
                        السيارات والحجوزات الخاصة ب ( <strong class="text-danger">{{$content->vendor?->name}}</strong> )
                    </strong>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">

                                <ul class="nav nav-pills mb-3" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-bs-toggle="pill" href="#primary-pills-home" role="tab" aria-selected="true">
                                            <div class="d-flex align-items-center">
                                                <div class="tab-icon"><i class='bx bx-home font-18 me-1'></i>
                                                </div>
                                                <div class="tab-title">بيانات المعرض</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="pill" href="#primary-pills-profile" role="tab" aria-selected="false">
                                            <div class="d-flex align-items-center">
                                                <div class="tab-icon"><i class='bx bx-car font-18 me-1'></i>
                                                </div>
                                                <div class="tab-title">السيارات الخاصة ب{{$content->vendor?->name}} </div>
                                                <span class="carsCount mx-2">{{count($content->cars)}}</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content p-4" id="pills-tabContent">

                                    {{--Profile Info--}}
                                    <div class="tab-pane fade show active" id="primary-pills-home" role="tabpanel">
                                        <div class="row align-items-center">
                                            <div class="col-md-2">
                                                <div class="vendor-img">
                                                    <img src="{{ $content->vendor?->image ? $content->vendor?->image : '/admin_dashboard/assets/images/no_image.png' }}" class="rounded-circle imageShow" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="vendorInfo">
                                                    <ul class="list-unstyled">
                                                        <li> الأسم : <strong class="text-primary">{{$content->vendor?->name}}</strong> </li>
                                                        <li> رقم الهاتف : <strong class="text-primary">{{$content->phone}}</strong> </li>
                                                        <li> رابط الخريطة : <strong class="text-primary">{{$content->vendor?->google_map ?? 'لا يوجد'}}</strong> </li>
                                                        <li>  حالة الحساب : <strong class="@if($content->vendor?->status) text-primary @else text-danger @endif">{{$content->vendor?->status ? 'مفعل ' : 'غير مفعل'}}</strong> </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="vendorInfo">
                                                    <ul class="list-unstyled">
                                                        <li> البريد الإلكتروني : <strong class="text-primary">{{$content->email}}</strong> </li>
                                                        <li> العنوان : <strong class="text-primary">{{$content->vendor?->address}}</strong> </li>
                                                        <li>  ساعات العمل : <strong class="text-primary">{{$content->vendor?->working_hours ?? 'لا يوجد'}}</strong> </li>
                                                        <li> تاريخ التسجيل : <strong class="text-primary">{{$content->created_at->diffForHumans()}} - {{date('Y-m-d H:i A', strtotime($content->created_at))}}</strong> </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Cars of vendor--}}
                                    <div class="tab-pane fade" id="primary-pills-profile" role="tabpanel">
                                        <div class="row">
                                            @if(count($content->cars) > 0)

                                                <div class="col-12">
                                                    @include('admin_dashboard.includes.live_search')
                                                    <div class="table-responsive mt-4">
                                                        <table class="table align-middle table-hover">
                                                            <thead class="table-secondary">
                                                            <tr>
                                                                <th>الصورة</th>
                                                                <th>الماركة والموديل</th>
                                                                <th>سعر اليوم الواحد</th>
                                                                <th>عدد الحجوزات</th>
                                                                <th>التحكم</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($content->cars as $car)
                                                                <tr>
                                                                    <td>
                                                                        <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                                            <img src="{{ $car->image }}" class="rounded-circle imageList" alt="">
                                                                        </div>
                                                                    </td>
                                                                    <td>{{$car->brand}} {{$car->model}}</td>
                                                                    <td><div class="carPrice">{{$car->price_per_day}} <span class="currency"> ج.م</span></div></td>
                                                                    <td>
                                                                        <span class="carsCount">{{$car->reservations->count()}}</span>
                                                                    </td>
                                                                    <td>
                                                                        <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                                                            <a href="{{route('cars.show', $car->id)}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                               title="عرض"><i class="lni lni-eye"></i></a>

                                                                            <a href="javascript:;"  data-bs-toggle="modal" data-bs-target="#deleteItem{{$car->id}}" class="text-danger" data-bs-toggle="tooltip"
                                                                               data-bs-placement="bottom" title="حذف"><i class="bi bi-trash-fill"></i></a>
                                                                            <div class="modal fade" id="deleteItem{{$car->id}}" tabindex="-1" aria-labelledby="link{{$car->id}}" aria-hidden="true">
                                                                                <div class="modal-dialog modal-dialog-centered">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="link{{$car->id}}">هل أنت متأكد من حذف هذا العنصر ؟</h5>
                                                                                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button class="btn btn-outline-default btn-sm me-2" type="button" data-bs-dismiss="modal">لا</button>
                                                                                            <form action="{{route('cars.destroy',$car->id)}}" method="POST">
                                                                                                @method('DELETE')
                                                                                                @csrf
                                                                                                <button type="submit" class="btn btn-outline-danger btn-sm" type="button">نعم</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-6 mx-auto">
                                                    <div class="text-center">
                                                        <img src="{{asset('admin_dashboard/assets/images/no_cars.png')}}" width="40%" />
                                                        <h4 class="mt-3">لا يوجد سيارات لهذا التاجر</h4>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
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
