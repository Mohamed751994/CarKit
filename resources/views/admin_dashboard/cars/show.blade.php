@extends('admin_dashboard.layout.master')
@section('Page_Title')
    تفاصيل السيارة
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="breadcrumb d-flex align-items-center justify-content-between">
                <div class="">
                    <a class="text-dark" href="{{route('vendors.show', $content->user_id)}}">{{$content->user?->vendor?->name}}</a>
                    <span class="mx-2">-</span>
                    <strong class="text-primary">
                        تفاصيل السيارة
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
                                                <div class="tab-icon"><i class='bx bx-car font-18 me-1'></i>
                                                </div>
                                                <div class="tab-title">بيانات السيارة</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="pill" href="#primary-pills-profile" role="tab" aria-selected="false">
                                            <div class="d-flex align-items-center">
                                                <div class="tab-icon"><i class='bx bx-car font-18 me-1'></i>
                                                </div>
                                                <div class="tab-title">الحجوزات </div>
                                                <span class="carsCount mx-2">{{count($content->reservations)}}</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content p-4" id="pills-tabContent">

                                    {{--Profile Info--}}
                                    <div class="tab-pane fade show active" id="primary-pills-home" role="tabpanel">
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <div class="vendor-img">
                                                    <img src="{{ $content->image ? $content->image : '/admin_dashboard/assets/images/no_image.png' }}" class=" w-100" alt="">
                                                </div>
                                                <div class="mt-4 text-center">
                                                    <h3 class="text-primary">{{$content->price_per_day}} <small class="text-dark font-13">ج.م لليوم الواحد</small></h3>
                                                </div>
                                            </div>
                                            <div class="col-md-3">

                                                <div class="vendorInfo">
                                                    <ul class="list-unstyled">
                                                        <li> <i class="bx bx-car mx-2"></i> <strong class="text-primary">{{$content->brand}} {{$content->model}}</strong> </li>
                                                        <li> <i class="bx bx-car mx-2"></i>  <strong class="text-primary">{{$content->year}}</strong> </li>
                                                        <li> <i class="bx bx-car mx-2"></i>  <strong class="text-primary">{{$content->fuel_type}}</strong> </li>
                                                        <li> <i class="bx bx-car mx-2"></i>  <strong class="text-primary">{{$content->motor_type}}</strong> </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-3">

                                                <div class="vendorInfo">
                                                    <ul class="list-unstyled">
                                                        <li> <i class="bx bx-car mx-2"></i>  <strong class="text-primary">{{$content->cc}} CC</strong> </li>
                                                        <li> <i class="bx bx-car mx-2"></i>  <strong class="text-primary">{{$content->kilometers}} km</strong> </li>
                                                        <li> <i class="bx bx-car mx-2"></i>  <strong class="text-primary">{{$content->color}}</strong> </li>
                                                        <li> <i class="bx bx-car mx-2"></i>  <strong class="text-primary">{{$content->seats}} مقعد</strong> </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="vendorInfo">
                                                    <ul class="list-unstyled">

                                                        <li> <i class="bx bx-car mx-2"></i>  <strong class="text-primary">{{$content->doors}} باب </strong> </li>
                                                        <li> <i class="bx bx-car mx-2"></i>  <strong class="text-primary">{{$content->outside_look}}</strong> </li>
                                                        <li> <i class="bx bx-car mx-2"></i>  <strong class="text-primary">{{$content->additions}}</strong> </li>
                                                        <li> <i class="bx bx-car mx-2"></i>  <strong class="text-primary">{{$content->features}}</strong> </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Cars of vendor--}}
                                    <div class="tab-pane fade" id="primary-pills-profile" role="tabpanel">
                                        <div class="row">
                                            @if(count($content->reservations) > 0)

                                                <div class="col-12">
                                                    <div class="table-responsive mt-4">
                                                        <table class="table align-middle mb-0">
                                                            <thead class="table-light">
                                                            <tr>
                                                                <th>الكود</th>
                                                                <th>السيارة</th>
                                                                <th>الأسم</th>
                                                                <th>رقم الهاتف</th>
                                                                <th>الحالة</th>
                                                                <th>التحكم</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @forelse($content->reservations as $con)
                                                                <tr>
                                                                    <td>{{$con->trip_num}}</td>
                                                                    <td>
                                                                        <div class="d-flex align-items-center gap-3">
                                                                            <div class="product-box border">
                                                                                <img src="{{json_decode($con->car_details)->image}}" alt="">
                                                                            </div>
                                                                            <div class="product-info">
                                                                                <h6 class="product-name mb-1">{{json_decode($con->car_details)->model}}</h6>
                                                                            </div>
                                                                            <div class="product-info">
                                                                                <small class="product-name mb-1">( {{json_decode($con->car_details)->user?->name}} )</small>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>{{$con->fname .' '. $con->lname}}</td>
                                                                    <td>{{$con->phone}}</td>
                                                                    <td>{!! $con->status !!}</td>
                                                                    <td>
                                                                        <div class="d-flex align-items-center gap-3 fs-6">
                                                                            <a href="{{route('tanants.show', $con->id)}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                               title="عرض"><i class="bi bi-eye-fill"></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr class="text-center">
                                                                    <td colspan="6">لا يوجد حجوزات حتي الآن</td>
                                                                </tr>
                                                            @endforelse
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
