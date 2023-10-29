<html>
<head>
    <link href="{{ asset('admin_dashboard/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body
        {
            font-family: 'Cairo' ,sans-serif;
            direction: rtl;
            text-align: center;
        }
    </style>
</head>
<body>


<section class="w-100" style="background: #f7f7f7;height: 100%;">
    <div class="container">
        <div class="row align-items-center justify-content-center" style="height: 100vh">
            <div class="col-md-8 mx-auto mt-5">
                <div class="row m-0 boxMail" style="background: white;padding: 45px; margin: 30px">
                    <div class="col-md-10 mx-auto" style="text-align: center;font-family: 'Roboto';font-weight: bold;direction: rtl;font-size: 18px;">
                        <img src="{{asset('admin_dashboard/assets/images/logo.png')}}" width="30%" />

                        @if($type == 'vendor')

                        @else
                        <h4 class="my-3 text-center">مرحباً {{$tanant->normal_user?->name}} .</h4>
                        <strong>
                            @if($tanant->status == 'approved')
                                تم <span class="text-success">الموافقة</span> علي طلب الحجز الخاص بك رقم <h3>{{$tanant->trip_num}}</h3>
                            @elseif($tanant->status == 'rejected')
                                    تم <span class="text-danger">الرفض</span> علي طلب الحجز الخاص بك رقم <h3>{{$tanant->trip_num}}</h3>
                            @endif
                        </strong>
                        @endif
                        <p style=" font-size: 14px;color: #858585;">
                            يمكنك التواصل من خلال الموقع في وجود أي مشكلة تواجهك.</p>
                        <div style="" class="footer">
                            <a href="{{getSettings('website_url')}}">الويب سايت</a>
                            <p>© {{date('Y')}} جميع الحقوق محفوظة  </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


</body>
</html>
