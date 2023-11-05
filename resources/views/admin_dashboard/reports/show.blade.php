@extends('admin_dashboard.layout.master')
@section('Page_Title')
    التقارير الخاصة ب
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="breadcrumb d-flex align-items-center justify-content-between">
                <div class="">
                    <a class="text-dark" href="{{route('reports.index')}}">التقارير</a>
                    <span class="mx-2">-</span>
                    <strong class="text-primary">
                        التقارير الخاصة ب  <strong class="text-danger"></strong>
                    </strong>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row g-3 mt-4">
                        <div class="col-12">
                            <div class="card shadow-none bg-light border">

                                <h1>{{$userID}}</h1>

                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div>

@endsection
