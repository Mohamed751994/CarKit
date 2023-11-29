@extends('admin_dashboard.layout.master')
@section('Page_Title')   الفواتير  @endsection
@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="breadcrumb d-flex align-items-center justify-content-between">
                <div class="">
                    <a class="text-dark" href="{{route('invoices.index')}}">الفواتير</a>
                    <span class="mx-2">-</span>
                    <strong class="text-primary">الفاتورة رقم ({{$content->trip_num}})</strong>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border p-5">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="invoice-section">
                                            <!--Head-->
                                            <div class="row invoice-head">
                                                <div class="col-12">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6>فاتورة</h6>
                                                        <h6>كاركيتس</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Body-->
                                            <div class="row invoice-body">

                                                <!--Invoice Info-->
                                                <div class="col-12">
                                                    <div class="info">
                                                        <ul class="list-unstyled">
                                                            <li>رقم الفاتورة : <strong>{{$content->trip_num}}</strong></li>
                                                            <li>تاريخ الحجز : <strong>{{$content->from_date}} <i class="mx-2 lni lni-arrow-left"></i> {{$content->to_date}}</strong></li>
                                                            <li> عدد الأيام : <strong>{{$content->days}} يوم</strong></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!--User & Vendor Info-->
                                                <div class="col-12">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="userInfo">
                                                            <ul class="list-unstyled">
                                                                <li>العميل : <strong>{{$content->fname .' '. $content->lname}}</strong></li>
                                                                <li>البريد الإلكتروني : <strong>{{$content->email}}</strong></li>
                                                                <li>الهاتف : <strong>{{$content->phone}}</strong></li>
                                                                <li>السن : <strong>{{$content->age}} سنة</strong></li>
                                                                <li>العنوان : <strong>{{$content->address}}</strong></li>
                                                            </ul>
                                                        </div>
                                                        <div class="userInfo">
                                                            <ul class="list-unstyled">
                                                                <li>المعرض : <strong>{{json_decode($content->car_details)->user?->vendor?->name}}</strong></li>
                                                                <li>البريد الإلكتروني : <strong>{{json_decode($content->car_details)->user?->email}}</strong></li>
                                                                <li>الهاتف : <strong>{{json_decode($content->car_details)->user?->phone}}</strong></li>
                                                                <li>العنوان : <strong>{{json_decode($content->car_details)->user?->vendor?->address ? json_decode($content->car_details)->user?->vendor?->address : 'القاهرة'}}</strong></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>



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
