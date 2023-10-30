@extends('admin_dashboard.layout.master')
@section('Page_Title') حجوزات العميل {{$content->name}} @endsection

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>   حجوزات العميل {{$content->name}} </h5>
            </div>

            @include('admin_dashboard.includes.live_search')
            <div class="table-responsive mt-4">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>الكود</th>
                        <th>السيارة</th>
                        <th>من - إلي</th>
                        <th>الأيام</th>
                        <th>سعر اليوم الواحد</th>
                        <th>السعر قبل الخصم</th>
                        <th>نسبة الخصم</th>
                        <th>السعر بعد الخصم</th>
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
                            <td>{{$con->from_date .' -> '. $con->to_date}}</td>
                            <td>{{$con->days}}</td>
                            <td>{{json_decode($con->car_details)->price_per_day}} جنية</td>
                            <td>{{$con->total_amount}} جنية</td>
                            <td>{{$con->discount_percentage}} %</td>
                            <td>{{$con->total_amount_after_discount}} جنية</td>
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
                            <td colspan="10">لا يوجد حجوزات حتي الآن</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

