@extends('admin_dashboard.layout.master')
@section('Page_Title')  أصحاب المعارض @endsection

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>  أصحاب المعارض </h5>
                <div class="ms-auto position-relative">
                    <a href="{{route('vendors.create')}}" class="btnIcon btn btn-outline-primary px-5"><i class="lni lni-circle-plus"></i> إنشاء جديد </a>
                </div>
            </div>

            @include('admin_dashboard.includes.live_search')
            <div class="table-responsive mt-4">
                <table class="table align-middle table-hover">
                    <thead class="table-secondary">
                    <tr>
                        <th>اللوجو</th>
                        <th>الأسم</th>
                        <th> تاريخ التسجيل</th>
                        <th> تحقق البريد الإلكتروني </th>
                        <th> الحالة </th>
                        <th> مميز </th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($content as $key =>$con)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3 cursor-pointer">
                                    <img src="{{ $con->vendor?->image ? $con->vendor?->image : '/admin_dashboard/assets/images/no_image.png' }}" class="rounded-circle imageList" alt="">
                                </div>
                            </td>
                            <td>{{$con->vendor?->name}}</td>
                            <td>{{date('Y-m-d H:i A', strtotime($con->created_at))}}</td>
                            <td>{!! $con->email_verified_at ? '<span class="badge bg-light-success text-success">محقق</span>' : '<span class="badge bg-light-danger text-danger">غير محقق</span>' !!}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input customSliderCheckbox" type="checkbox"
                                           name="status" onchange="quickChange(this,'{{$con->vendor?->id}}', 'Vendor', 'status')" id="flexSwitchCheckChecked" @if($con->vendor?->status) value="0" checked="" @else value="1" @endif>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input customSliderCheckbox" type="checkbox"
                                           name="featured" onchange="quickChange(this,'{{$con->vendor?->id}}', 'Vendor', 'featured')" id="flexSwitchCheckChecked" @if($con->vendor?->featured) value="0" checked="" @else value="1" @endif>
                                </div>
                            </td>
                            <td>
                                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                    <a href="{{route('vendors.show', $con->id)}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                       title="عرض"><i class="lni lni-eye"></i></a>
                                    <a href="{{route('vendors.edit', $con->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom"
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
                                                    <form action="{{route('vendors.destroy',$con->id)}}" method="POST">
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
                                <td colspan="6" class="text-center">
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
