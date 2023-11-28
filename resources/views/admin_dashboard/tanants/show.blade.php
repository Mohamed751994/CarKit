@extends('admin_dashboard.layout.master')
@section('Page_Title')   الحجوزات  @endsection
@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="breadcrumb d-flex align-items-center justify-content-between">
                <div class="">
                    <a class="text-dark" href="{{route('tanants.index')}}">الحجوزات</a>
                    <span class="mx-2">-</span>
                    <strong class="text-primary">معلومات الحجز</strong>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border p-5">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>معلومات الحجز : </h4>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="w-100 py-3">
                                            {!! $content->status !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="client-info vendorInfo">
                                            <ul class="list-unstyled">
                                                <li>كود الحجز : <strong class="text-primary">{{$content->trip_num}}</strong></li>
                                                <li>اسم الحاجز : <strong class="text-primary">{{$content->fname .' '. $content->lname}}</strong></li>
                                                <li>رقم هاتف الحاجز : <strong class="text-primary">{{$content->phone}}</strong></li>
                                                <li>البريد الإلكتروني : <strong class="text-primary">{{$content->email}}</strong></li>
                                                <li>السن : <strong class="text-primary">{{$content->age}}</strong></li>
                                                <li>العنوان : <strong class="text-primary">{{$content->address}}</strong></li>
                                            </ul>
                                        </div>
                                        <div class="">
                                            <div class="boxImg">
                                                <img class="mb-2" src="{{$content->nid_img}}" width="65%" />
                                                <h5 class="mt-2">صورة البطاقة الشخصية</h5>
                                            </div>
                                            <div class="boxImg">
                                                <img class="mb-2" src="{{$content->license_img}}" width="65%" />
                                                <h5 class="mt-2">صورة الرخصة</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="client-info vendorInfo">
                                            <ul class="list-unstyled">
                                                <li>اسم المعرض : <strong class="text-primary">{{json_decode($content->car_details)->user?->name}}</strong></li>
                                                <li>بداية الحجز : <strong class="text-primary">{{$content->from_date}}</strong></li>
                                                <li>نهاية الحجز : <strong class="text-primary">{{$content->to_date}}</strong></li>
                                                <li>عدد الأيام : <strong class="text-primary">{{ $content->days}}</strong></li>
                                                <li>سعر اليوم الواحد : <strong class="text-primary">{{ json_decode($content->car_details)->price_per_day}} ج.م</strong></li>
                                                @if($content->car_features)
                                                    @foreach($content->car_features as $feature)
                                                        <li>{{$feature->name}} : <strong class="text-primary">{{$feature->price}} ج.م</strong></li>
                                                    @endforeach
                                                @endif
                                                <li>السعر قبل الخصم : <strong class="text-primary">{{$content->total_amount + $content->feature_total_price}} ج.م</strong></li>
                                                <li>نسبة الخصم : <strong class="text-primary">{{$content->discount_percentage}} %</strong></li>
                                                <li>السعر بعد الخصم : <strong class="text-primary">{{$content->final_total}} ج.م</strong></li>
                                            </ul>
                                        </div>
                                        <div class="">
                                            <div class="boxImg">
                                                <img class="mb-2" src="{{json_decode($content->car_details)->image}}" width="65%" />
                                                <h5 class="mt-2">{{json_decode($content->car_details)->model}}</h5>
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
