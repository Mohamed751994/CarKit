@extends('admin_dashboard.layout.master')

@section('Page_Title')  لوحة التحكم @endsection

@section('content')

    <div class="row mb-5">
        <div class="col-6 col-lg-3">
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
        <div class="col-6 col-lg-3">
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
        <div class="col-6 col-lg-3">
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
        <div class="col-6 col-lg-3">
            <div class="card radius-10 bg-success">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
                        <i class="lni lni-offer"></i>
                    </div>
                    <h3 class="text-white">{{$reservations}}</h3>
                    <p class="mb-0 text-white">الحجوزات</p>
                </div>
            </div>
        </div>

    </div>

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
                                <th>تاريخ الحجز</th>
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
                                        <td>{{$order->created_at->diffForHumans()}}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3 fs-6">
                                                <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><i class="bi bi-eye-fill"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">لا يوجد حجوزات حتي الآن</td>
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

