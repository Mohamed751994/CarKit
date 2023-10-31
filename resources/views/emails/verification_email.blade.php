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
                        <h4 class="my-3 text-center">مرحباً {{$user->name}} .</h4>
                        <strong>للتحقق من بريدك الإلكتروني اضغط علي الرابط التالي لتفعيل الحساب ثم قم بتسجيل الدخول</strong>
                        <a href="{{$link}}" style="width:50%;margin: 30px auto;display: block; background: #f94a29; padding: 20px;color: #fff; text-decoration: auto;font-weight: bold;">تفعيل الحساب</a>
                        <p style=" font-size: 14px;color: #858585;">ستنتهي صلاحية هذا الرابط عند تغييرك لكلمة المرور. لطلب رابط جديد
                            أو إذا انتهت صلاحية الرابط الخاص بك، يمكنك طلب رابط جديد عبر نسيت كلمة المرور من خلال الموقع.</p>
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
