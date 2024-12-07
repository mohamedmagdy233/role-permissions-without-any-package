<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إعادة تعيين كلمة المرور</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f6f6f6;
            margin: 0;
            padding: 20px;
            direction: rtl;
            text-align: right;
        }

        .email-container {
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            max-width: 600px;
            overflow: hidden;
            padding: 0;
        }

        .email-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .email-body {
            padding: 20px;
        }

        .email-footer {
            color: #999999;
            font-size: 12px;
            text-align: center;
            padding: 10px 20px;
            border-top: 1px solid #eeeeee;
        }

        .btn-copy {
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h1 class="mb-0">إعادة تعيين كلمة المرور</h1>
    </div>
    <div class="email-body">
        <p>لقد طلبت استعادة كلمة المرور.</p>
        <p>لا تشارك هذا الكود مع أحد:</p>
        <div class="form-group">
            <input type="text" class="form-control" id="codeInput" value="{{ $code }}" readonly>
            <button class="btn btn-primary btn-copy mt-2" onclick="copyCode()">نسخ الكود</button>
        </div>
        <p>شكراً لتواصلك معنا.</p>
    </div>
    <div class="email-footer">
        <p>&copy; {{ date('Y') }} جميع الحقوق محفوظة.</p>
    </div>
</div>

<script>
    function copyCode() {
        var codeInput = document.getElementById('codeInput');
        codeInput.select();
        codeInput.setSelectionRange(0, 99999); // For mobile devices
        navigator.clipboard.writeText(codeInput.value).then(function() {
            alert('الكود تم نسخه إلى الحافظة');
        }, function() {
            alert('حدث خطأ أثناء نسخ الكود');
        });
    }
</script>
</body>
</html>
