<html>
<head></head>
<body>


<div style="width: 100%; padding: 30px; text-align: center; background: #0a58ca">
    <img src="{{asset('admin_dashboard/assets/images/logo.png')}}" height="150px">
</div>
<br>
<br>
<div style="width: 100%; text-align: center">
    <h1>إستعادة كلمة المرور</h1>
</div>
<div style="width: 100%; text-align: right">
    <h3>مرحباً {{$user->email}}</h3>
    <strong>يمكنك تغيير كلمة المرور من خلال الرابط التالي</strong>
    <br>
    <div style="text-align: center">
        <a href="{{$link}}" style="background: #0a58ca; color: #FFFFFF; padding: 20px 10px;border-radius: 10px;" target="_blank">إستعادة كلمة المرور</a>
    </div>
</div>
</body>
</html>
