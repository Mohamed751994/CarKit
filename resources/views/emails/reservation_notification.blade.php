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
                            <h4 class="my-3 text-center">مرحباً {{$tanant->vendor_user?->name}} .</h4>
                            <h2 class="text-center mb-3">طلب حجز سيارة</h2>
                            <ul style="width: 100%">
                                <li style="margin-bottom: 10px;">كود الحجز : <strong>{{$tanant->trip_num}}</strong></li>
                                <li style="margin-bottom: 10px;"> السيارة : <strong><img src="{{json_decode($tanant->car_details)->image}}" style="width: 70px; border-radius: 50%; height: 70px;object-fit: cover;margin:0 10px;"> {{json_decode($tanant->car_details)->model}}</strong></li>
                                <li style="margin-bottom: 10px;">عدد الأيام : <strong>{{$tanant->days}} يوم</strong></li>
                                <li style="margin-bottom: 10px;">من - إلي : <strong>{{$tanant->from_date}} -> {{$tanant->to_date}}</strong></li>
                            </ul>
                            <strong style="margin-top: 20px;">يمكنك متابعة الحجز من خلاص حجوزاتك في صفحتك الشخصية</strong>
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
