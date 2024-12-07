<!DOCTYPE html>
<html lang="ar">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('admin.auth.css')
</head>

<div class="container">
    <main class="signup-container" style="margin-top: 40px">
        <h1 class="heading-primary">تسجيل الدخول<span class="span-blue">.</span></h1>
        <p class="text-mute">يرجي ادخال بيانات التحقق</p>

        <form class="signup-form" action="{{route('admin.login')}}" method="post" id="LoginForm">
            @csrf
            <label class="inp">
                <input type="email" name="email" class="input-text" placeholder="&nbsp;">
                <span class="label">البريد الإلكتروني</span>
                <span class="input-icon"><i class="fa-solid fa-envelope"></i></span>
            </label>
            <label class="inp">
                <input type="password" name="password" class="input-text" placeholder="&nbsp;" id="password">
                <span class="label">كلمة المرور</span>
                <span class="input-icon input-icon-password" data-password><i class="fa-solid fa-eye"></i></span>
            </label>
            <button class="btn btn-login" id="loginButton">تسجيل الدخول</button>
        </form>
    </main>
    <div class="welcome-container">
        <h1 class="heading-secondary">مرحبا بعودتك <span class="lg">{{isset($setting) ? $setting->title_ar : 'تطبيق'}}</span></h1>
        <img src="{{ isset($setting) ? asset($setting->logo): asset('assets/uploads/logo.png')}}" alt="login" style="max-width:450px;mix-blend-mode: multiply">
    </div>
</div>

@include('admin.auth.js')
</html>
