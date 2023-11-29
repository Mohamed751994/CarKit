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
                                            <div class="row invoice-head justify-content-between align-items-center">
                                                <div class="col-12">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6>فاتورة</h6>
                                                        <h6>كاركيتس</h6>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="info">
                                                            <ul class="list-unstyled">
                                                                <li>رقم الفاتورة : <strong>{{$content->trip_num}}</strong></li>
                                                                <li>تاريخ الحجز : <strong>{{$content->from_date}} <i class="mx-2 lni lni-arrow-left"></i> {{$content->to_date}}</strong></li>
                                                                <li> عدد الأيام : <strong>{{$content->days}} يوم</strong></li>
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
