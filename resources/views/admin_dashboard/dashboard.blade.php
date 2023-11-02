@extends('admin_dashboard.layout.master')

@section('Page_Title')  لوحة التحكم @endsection

@section('content')
    <style>
        .mostVendorImg
        {
            background: #efefef;
            display: inline-block;
            border-radius: 5px;
            margin: 5px;
        }
    </style>
    <div class="row mb-5">
        <div class="col-6 col-lg-2">
            <div class="card radius-10 bg-tiffany">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
                        <i class="lni lni-users"></i>
                    </div>
                    <h3 class="text-white">{{$vendors}}</h3>
                    <p class="mb-0 text-white">أصحاب المعارض</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-2">
            <div class="card radius-10 bg-purple">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h3 class="text-white">{{$users}}</h3>
                    <p class="mb-0 text-white">العملاء</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-2">
            <div class="card radius-10 bg-orange">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
                        <i class="lni lni-car"></i>
                    </div>
                    <h3 class="text-white">{{$cars}}</h3>
                    <p class="mb-0 text-white">السيارات المعروضة</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-2">
            <div class="card radius-10 bg-warning">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
                        <i class="lni lni-offer"></i>
                    </div>
                    <h3 class="text-white">{{$reservations_pending}}</h3>
                    <p class="mb-0 text-white">الحجوزات (في الأنتظار)</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-2">
            <div class="card radius-10 bg-success">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
                        <i class="lni lni-offer"></i>
                    </div>
                    <h3 class="text-white">{{$reservations_approved}}</h3>
                    <p class="mb-0 text-white">الحجوزات المؤكدة</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-2">
            <div class="card radius-10 bg-danger">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
                        <i class="lni lni-offer"></i>
                    </div>
                    <h3 class="text-white">{{$reservations_rejected}}</h3>
                    <p class="mb-0 text-white">الحجوزات الملغية</p>
                </div>
            </div>
        </div>

    </div>


    <div class="row mb-5">
        <div class="col-12 col-lg-6 d-flex">
            <div class="card rounded-4 w-100">
                <div class="card-header bg-transparent border-0">
                    <div class="row g-3 align-items-center">
                        <div class="col">
                            <h6 class="mb-0 mt-3">السيارات الأكثر حجزاً</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="best-product p-2 mb-3">
                        @forelse($most_reserve_cars as $key => $val)
                            <div class="best-product-item">
                            <a href="{{route('cars.show', $val->car_id)}}" class="d-flex align-items-center gap-3">
                                <div class="product-box border">
                                    <img src="{{json_decode($val->car_details)->image}}" alt="">
                                </div>
                                <div class="product-info flex-grow-1">
                                    <div class="progress-wrapper">
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-success" role="progressbar" @if($key == 0) style="width: 80%;"
                                                 @elseif($key ==1)  style="width: 70%;" @elseif($key == 2)  style="width: 60%;"
                                                 @elseif($key == 3)  style="width: 50%;"
                                                 @elseif($key == 4)  style="width: 40%;" @endif></div>
                                        </div>
                                    </div>
                                    <p class="product-name mb-0 mt-2 fs-6">{{json_decode($val->car_details)->model}} <small>( {{json_decode($val->car_details)->user?->name}} )</small> <span class="float-end">{{$val->count}}</span></p>
                                </div>
                            </a>
                        </div>
                        @empty
                            <strong>لا يوجد حجوزات حتي الآن</strong>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 d-flex">
            <div class="col d-flex">
                <div class="card rounded-4 overflow-hidden w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h6 class="mb-0">المعارض الأكثر تأجيراً</h6>
                        </div>
                        <div class="by-device-container p-3">
                            @foreach($most_reserve_vendors as $vendorImg)
                                <div class="mostVendorImg">
                                    <a href="{{route('vendors.show', $vendorImg->vendor_user_id)}}">
                                    <img style="height: 100px;width: 100px;object-fit: contain" src="{{$vendorImg->vendor_user?->vendor?->image ? $vendorImg->vendor_user?->vendor?->image : '/admin_dashboard/assets/images/no_image.png'}}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        @forelse($most_reserve_vendors as $vendor)
                            <li class="list-group-item d-flex align-items-center justify-content-between bg-transparent border-top">
                                <i class="bi bi-tablet-landscape-fill me-2 text-primary"></i> <span>{{$vendor->vendor_user?->name}} - </span> <span>{{$vendor->count}} حجز</span>
                            </li>
                        @empty
                            <li class="list-group-item d-flex align-items-center justify-content-between bg-transparent border-top">
                                لا يوجد بيانات
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div><!--end row-->


    <div class="row">
        <div class="col-12 col-lg-12 col-xl-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-3 text-secondary">أخر 10 حجوزات</h6>
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>الكود</th>
                                <th>السيارة</th>
                                <th>الأسم</th>
                                <th>رقم الهاتف</th>
                                <th> الحالة</th>
                                <th>التحكم</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($latest_10_orders as $order)
                                    <tr>
                                        <td>{{$order->trip_num}}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="product-box border">
                                                    <img src="{{json_decode($order->car_details)->image}}" alt="">
                                                </div>
                                                <div class="product-info">
                                                    <h6 class="product-name mb-1">{{json_decode($order->car_details)->model}}</h6>
                                                </div>
                                                <div class="product-info">
                                                    <small class="product-name mb-1">( {{json_decode($order->car_details)->user?->name}} )</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$order->fname .' '. $order->lname}}</td>
                                        <td>{{$order->phone}}</td>
                                        <td>{!! $order->status !!}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3 fs-6">
                                                <a href="{{route('tanants.show', $order->id)}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                   title="عرض"><i class="bi bi-eye-fill"></i></a>                                            </div>
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
            </div>
        </div>
    </div>


@endsection

@push('scripts')
@endpush
