@extends('admin_dashboard.layout.master')
@section('Page_Title') الحجوزات @endsection

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>  الحجوزات </h5>
            </div>


            <div class="row my-3 align-items-center justify-content-between">
                <div class="col-6 col-md-3">
                    <div class="card radius-10">
                        <div class="card-body text-center">
                            <div class="widget-icon mx-auto mb-3 bg-light-warning text-warning">
                                <i class="bi bi-tags-fill"></i>
                            </div>
                            <h3>{{tanantsStatusTypeCount('pending')['count']}}</h3>
                            <p class="mb-0">في الإنتظار</p>
                            <div class="my-3">
                                <strong>{{tanantsStatusTypeCount('pending')['money']}} جنية مصري</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card radius-10">
                        <div class="card-body text-center">
                            <div class="widget-icon mx-auto mb-3 bg-light-success text-success">
                                <i class="bi bi-tags-fill"></i>
                            </div>
                            <h3>{{tanantsStatusTypeCount('approved')['count']}}</h3>
                            <p class="mb-0">تم التأكيد</p>
                            <div class="my-3">
                                <strong>{{tanantsStatusTypeCount('approved')['money']}} جنية مصري</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card radius-10">
                        <div class="card-body text-center">
                            <div class="widget-icon mx-auto mb-3 bg-light-orange text-orange">
                                <i class="bi bi-tags-fill"></i>
                            </div>
                            <h3>{{tanantsStatusTypeCount('cancelled')['count']}}</h3>
                            <p class="mb-0">ملغي</p>
                            <div class="my-3">
                                <strong>{{tanantsStatusTypeCount('cancelled')['money']}} جنية مصري</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card radius-10">
                        <div class="card-body text-center">
                            <div class="widget-icon mx-auto mb-3 bg-light-danger text-danger">
                                <i class="bi bi-tags-fill"></i>
                            </div>
                            <h3>{{tanantsStatusTypeCount('rejected')['count']}}</h3>
                            <p class="mb-0">مرفوض</p>
                            <div class="my-3">
                                <strong>{{tanantsStatusTypeCount('rejected')['money']}} جنية مصري</strong>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            @include('admin_dashboard.includes.live_search')
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
                    @forelse($content as $con)
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
                <div>
                    {{$content->links()}}
                </div>
            </div>
        </div>
    </div>


@endsection

