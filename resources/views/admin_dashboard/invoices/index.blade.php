@extends('admin_dashboard.layout.master')
@section('Page_Title') الفواتير @endsection

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>  الفواتير </h5>
            </div>


            <div class="row justify-content-between align-items-center mt-3">
                <div class="col-md-4">
                    <form action="{{route('invoices.index')}}" method="GET" id="filterVendor">
                        <select class="form-control form-select" name="vendor" onchange="$('#filterVendor').submit()">
                            <option value="0">فلتر بأسم المعرض</option>
                            @foreach($vendors as $val=>$key)
                                <option value="{{$val}}" @selected($val == request('vendor'))>{{$key}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>

            <div class="table-responsive mt-4">
                <table class="table align-middle mb-0 text-center">
                    <thead class="table-light">
                    <tr>
                        <th>الكود</th>
                        <th>المعرض</th>
                        <th>السعر الإجمالي</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($content as $con)
                        <tr>
                            <td>{{$con->trip_num}}</td>
                            <td>
                                {{json_decode($con->car_details)->user?->name}}
                            </td>
                            <td>{{$con->total_amount_after_discount}} ج.م</td>
                            <td>
                                <a href="{{route('invoices.show', $con->id)}}" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                ><i class="bi bi-eye-fill mx-2"></i> عرض الفاتورة</a>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="3">لا يوجد فواتير حتي الآن</td>
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

