@extends('admin_dashboard.layout.master')
@section('Page_Title')  التقارير @endsection
@push('styles')
    <link href="{{ asset('admin_dashboard/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('admin_dashboard/assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
    <style>
        .select2-container--bootstrap4 .select2-selection--single .select2-selection__arrow {
            right: 95% !important;
        }
    </style>
@endpush
@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bi bi-grid-fill"></i> التقارير </h5>
            </div>

           <div class="row mt-3">
               <div class="col-6">
                   <label for="vendors">أصحاب المعارض</label>
                   <select class="single-select form-control form-select" name="vendors" id="vendors">
                       <option value="">اختر تقرير صاحب المعرض</option>
                       @foreach($vendors as $key => $val)
                       <option value="{{$val}}">{{$key}}</option>
                       @endforeach
                   </select>
               </div>
               <div class="col-6">
                   <label for="users">المستخدمين</label>
                   <select class="single-select form-control form-select" name="users" id="users">
                       <option value="">اختر تقرير مستخدم معين</option>
                       @foreach($users as $key => $val)
                           <option value="{{$val}}">{{$key}}</option>
                       @endforeach
                   </select>
               </div>
           </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script src="{{ asset('admin_dashboard/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{ asset('admin_dashboard/assets/js/form-select2.js')}}"></script>

    <script>
        $(document).on('change', '#vendors', function(){
            const userID = $(this).val();
            $.ajax({
                url: "{{route('reports.report')}}",
                type: 'post',
                data: {_token: '{{csrf_token()}}',userID:userID},
                success: function(response) {
                    if(response.success)
                    {

                    }
                },
                error: function (reject) {

                },
            });
        });
    </script>
@endpush
