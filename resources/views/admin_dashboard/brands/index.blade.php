@extends('admin_dashboard.layout.master')
@section('Page_Title')  ماركات السيارات @endsection

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>  ماركات السيارات </h5>
                <div class="ms-auto position-relative">
                    <a href="{{route('brands.create')}}" class="btnIcon btn btn-outline-primary px-5"><i class="lni lni-circle-plus"></i> إنشاء جديد </a>
                </div>
            </div>

            @include('admin_dashboard.includes.live_search')
            <div class="table-responsive mt-4">
                <table class="table align-middle table-hover">
                    <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>الماركة</th>
                        <th>الموديلات</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($content as $key =>$con)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$con->brand_name}}</td>
                            <td>
                                @if(!empty($con->models))
                                @foreach($con->models as $model)
                                    <span class="badge bg-light-primary text-primary">{{$model->model_name}}</span>
                                @endforeach
                                    @endif
                            </td>
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    <a href="{{route('brands.edit', $con->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                       title="تعديل"><i class="bi bi-pencil-fill"></i></a>
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
                                                    <form action="{{route('brands.destroy',$con->id)}}" method="POST">
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
                                <td colspan="4" class="text-center">
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

