@extends('admin_dashboard.layout.master')
@section('Page_Title')  السيارات @endsection

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>  السيارات </h5>
            </div>

            <div class="row justify-content-between align-items-center mt-3">
                <div class="col-md-4">
                    <form action="{{route('cars.index')}}" method="GET" id="filterVendor">
                        <select class="form-control form-select" name="vendor" onchange="$('#filterVendor').submit()">
                            <option value="0">فلتر بأسم المعرض</option>
                            @foreach($vendors as $val=>$key)
                                <option value="{{$val}}" @selected($val == request('vendor'))>{{$key}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="col-md-4">
                    @include('admin_dashboard.includes.live_search')
                </div>
            </div>

            <div class="table-responsive mt-4">
                <table class="table align-middle table-hover">
                    <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>السيارة</th>
                        <th>المعرض</th>
                        <th>عدد الحجوزات</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($content as $key =>$con)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-3 cursor-pointer">
                                        <img src="{{ $con->image ? $con->image : '/admin_dashboard/assets/images/no_image.png' }}" class="rounded-circle imageList" alt="">
                                        <strong class="mx-2">{{$con->brands->brand_name}} {{$con->model}}</strong>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center gap-3 cursor-pointer">
                                        <img src="{{ $con->user?->vendor?->image ? $con->user?->vendor?->image : '/admin_dashboard/assets/images/no_image.png' }}" class="rounded-circle imageList" alt="">

                                        <strong class="mx-2">{{$con->user?->vendor?->name}}</strong>
                                        <strong class="mx-2 badge @if($con->user?->vendor?->status) bg-light-success text-success @else bg-light-danger text-danger @endif">({{$con->user?->vendor?->status ? 'مفعل' : 'غير مفعل'}})</strong>
                                    </div>
                                </td>
                                <td>
                                    <span class="carsCount">{{$con->reservations_count}}</span>
                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <a href="{{route('cars.show', $con->id)}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                           title="عرض"><i class="lni lni-eye"></i></a>

                                        <a href="javascript:;"  data-bs-toggle="modal" data-bs-target="#deleteItem{{$con->id}}" class="text-danger" data-bs-toggle="tooltip"
                                           data-bs-placement="bottom" title="حذف"><i class="bi bi-trash-fill"></i></a>
                                        <div class="modal fade" id="deleteItem{{$con->id}}" tabindex="-1" aria-labelledby="link{{$con->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="link{{$con->id}}">هل أنت متأكد من حذف هذا العنصر ؟</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-outline-default btn-sm me-2" type="button" data-bs-dismiss="modal">لا</button>
                                                        <form action="{{route('cars.destroy',$con->id)}}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-danger btn-sm" type="button">نعم</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <p> لا يوجد بيانات </p>
                                </td>
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

