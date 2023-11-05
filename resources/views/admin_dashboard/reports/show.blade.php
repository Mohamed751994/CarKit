<div class="row">

    {{--User Info--}}
    <section class="user_info">
        <div class="col-12 text-center">
            <h4 class="fw-bold">المعلومات الشخصية</h4>
        </div>
        <div class="row m-0">
            <div class="{{$user->type == 'vendor' ? 'col-md-6' : 'col-md-12'}}">
                <ul class="list-unstyled userInfoReport">
                    <li><i class="bx bx-user-check mx-1"></i> {{$user->name}}</li>
                    <li><i class="bx bx-envelope mx-1"></i> {{$user->email}}</li>
                    <li><i class="bx bx-phone mx-1"></i> {{$user->phone}}</li>
                    <li><i class="bx bx-calendar mx-1"></i>  تاريخ الإنضمام : {{$user->created_at}}</li>
                    <li><i class="bx bx-check mx-1"></i>  @if($user->email_verified_at) <strong class="text-success">الحساب محقق</strong>
                        @else <strong class="text-danger">الحساب غير محقق</strong>  @endif</li>
                </ul>
            </div>
            @if($user->type == 'vendor')
                <div class="col-md-4">
                    <ul class="list-unstyled userInfoReport">
                        <li><i class="bx bx-map mx-1"></i> {{$user->address}}</li>
                        <li><i class="bx bx-check-circle mx-1"></i>  @if($user->vendor?->status) <strong class="text-success">الحساب مفعل</strong>
                            @else <strong class="text-danger">الحساب غير مفعل</strong>  @endif</li>
                        <li><i class="bx bx-check-circle mx-1"></i>  @if($user->vendor?->featured) <strong class="text-success">الحساب مميز</strong>
                            @else <strong class="text-danger">الحساب غير مميز</strong>  @endif</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    @if($user->vendor?->image)
                        <img src="{{$user->vendor?->image}}" style="height: 150px;width: 150px;border-radius: 50%;object-fit: contain" alt="{{$user->name}}">
                    @endif
                </div>
            @endif
        </div>
    </section>


    {{--User Stats--}}
    <section class="user_info">
        <div class="row m-0 align-items-center">
            @if($user->type == 'vendor')
                <div class="col-md-3">
                    <div class="boxStats">
                        <h5 class="title">عدد السيارات</h5>
                        <h1 class="count">{{$cars}} <small>سيارة</small></h1>
                        <i class="bx bx-car"></i>
                    </div>
                </div>
            @endif
                <div class="{{$user->type == 'vendor' ? 'col-md-3' : 'col-md-4'}}">
                    <div class="boxStats">
                        <h5 class="title">الحجوزات (في الإنتظار)</h5>
                        <h1 class="count text-warning">{{$pending['count']}} <small>حجز</small> </h1>
                        <h1 class="money text-warning">{{$pending['money']}} <small>جنية</small></h1>
                        <i class="bx bx-money"></i>
                    </div>
                </div>
                <div class="{{$user->type == 'vendor' ? 'col-md-3' : 'col-md-4'}}">
                    <div class="boxStats">
                        <h5 class="title">الحجوزات (المؤكدة)</h5>
                        <h1 class="count text-success">{{$approved['count']}} <small>حجز</small></h1>
                        <h1 class="money text-success">{{$approved['money']}} <small>جنية</small></h1>
                        <i class="bx bx-money"></i>
                    </div>
                </div>
                <div class="{{$user->type == 'vendor' ? 'col-md-3' : 'col-md-4'}}">
                    <div class="boxStats">
                        <h5 class="title">الحجوزات (المرفوضة)</h5>
                        <h1 class="count text-danger">{{$rejected['count']}} <small>حجز</small></h1>
                        <h1 class="money text-danger">{{$rejected['money']}} <small>جنية</small></h1>
                        <i class="bx bx-money"></i>
                    </div>
                </div>
        </div>
    </section>


</div>
