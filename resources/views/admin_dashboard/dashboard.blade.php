@extends('admin_dashboard.layout.master')

@section('Page_Title')  لوحة التحكم @endsection

@push('styles')
    <style>
        .mostVendorImg
        {
            background: #efefef;
            display: inline-block;
            border-radius: 5px;
            margin: 5px;
        }
    </style>
@endpush

@section('content')

    <div class="row mb-2">
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
            <div class="card radius-10 bg-bronze">
                <div class="card-body text-center">
                    <div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
                        <i class="lni lni-car"></i>
                    </div>
                    <h3 class="text-white">{{$reservations_count}}</h3>
                    <p class="mb-0 text-white">عدد الحجوزات</p>
                </div>
            </div>
        </div>


        {{--Chart1--}}
        <div class="col-md-8">
            <div class="card rounded-4 w-100">
                <div class="card-header bg-transparent border-0">
                    <div class="row g-3 align-items-center">
                        <div class="col">
                            <h6 class=" mb-0 mt-3"> الحجوزات</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body py-4">
                    <div class="charts-payments">
                        <canvas id="myChart1" class="w-100"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{--Chart2--}}
        <div class="col-md-4">
            <div class="card rounded-4 w-100">
                <div class="card-header bg-transparent border-0">
                    <div class="row g-3 align-items-center">
                        <div class="col">
                            <h6 class=" mb-0 mt-3">أصحاب المعارض</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body py-4">
                    <div class="charts-payments">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>


    </div>

    {{--Most car reserved && Most Vendors Reserved--}}
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
                                                 @elseif($key == 4)  style="width: 40%;" @elseif($key == 5)  style="width: 30%;" @endif></div>
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

    {{--Last 10 car reserved--}}
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx1 = document.getElementById('myChart1');

        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: [
                    'الحجوزات المرفوضة '+' ('+{{$reservations_rejected}}+')',
                    'الحجوزات الملغية'+' ('+{{$reservations_cancelled}}+')',
                    'الحجوزات المؤكدة'+' ('+{{$reservations_approved}}+')',
                    'الحجوزات في الأنتظار'+' ('+{{$reservations_pending}}+')'
                ],
                datasets: [{
                    label: '# of Votes',
                    data: [{{$reservations_rejected}},{{$reservations_cancelled}},{{$reservations_approved}},{{$reservations_pending}}],
                    borderWidth: 1,
                    borderColor: ['#ffffff', '#ffffff', '#ffffff', '#ffffff'], // Add custom color border
                    backgroundColor: ['#ffcb32', '#12bf24','#ff6500', '#f03e0b'], // Add custom color background (Points and Fill)
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        Chart.defaults.font.size = 14;
        var ctx2 = document.getElementById("myChart2").getContext('2d');
        var myChart = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: [
                    'الحجوزات المرفوضة '+' ('+{{$reservations_rejected}}+')',
                    'الحجوزات الملغية'+' ('+{{$reservations_cancelled}}+')',
                    'الحجوزات المؤكدة'+' ('+{{$reservations_approved}}+')',
                    'الحجوزات في الأنتظار'+' ('+{{$reservations_pending}}+')'
                ],
                datasets: [{
                    data: [{{$reservations_rejected}},{{$reservations_cancelled}},{{$reservations_approved}},{{$reservations_pending}}],

                    borderColor: ['#ffffff', '#ffffff', '#ffffff', '#ffffff'], // Add custom color border
                    backgroundColor: ['#ffcb32', '#12bf24','#ff6500', '#f03e0b'], // Add custom color background (Points and Fill)
                    borderWidth: 1 // Specify bar border width
                }]},
            options: {
                responsive: true, // Instruct chart js to respond nicely.
                maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
            }
        });

    </script>

@endpush
