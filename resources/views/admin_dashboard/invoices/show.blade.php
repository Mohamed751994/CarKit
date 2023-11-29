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
                                                    <div class="col"></div>
                                                    <h6>فاتورة</h6>
                                                </div>
                                                <div class="col-8">

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
