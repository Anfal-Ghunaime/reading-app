{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Email Verification</title>--}}
{{--    <style>--}}
{{--        body {--}}
{{--            font-family: Arial, sans-serif;--}}
{{--            margin: 0;--}}
{{--            padding: 0;--}}
{{--            background-color: #f4f4f4;--}}
{{--            display: flex;--}}
{{--            justify-content: center;--}}
{{--            align-items: center;--}}
{{--            height: 100vh;--}}
{{--        }--}}

{{--        .email-container {--}}
{{--            position: relative;--}}
{{--            width: 80%;--}}
{{--            max-width: 500px;--}}
{{--            background-color: #fff;--}}
{{--            padding: 20px;--}}
{{--            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);--}}
{{--            text-align: center;--}}
{{--        }--}}

{{--        .logo-background {--}}
{{--            position: absolute;--}}
{{--            top: 50%;--}}
{{--            left: 50%;--}}
{{--            transform: translate(-50%, -50%);--}}
{{--            background-image: url({{ asset('logo/logo.jpg') }});--}}
{{--            background-size: contain;--}}
{{--            background-repeat: no-repeat;--}}
{{--            opacity: 0.1;--}}
{{--            width: 100%;--}}
{{--            height: 100%;--}}
{{--            z-index: 0;--}}
{{--        }--}}

{{--        .email-content {--}}
{{--            position: relative;--}}
{{--            z-index: 1;--}}
{{--        }--}}

{{--        .verification-code {--}}
{{--            font-size: 24px;--}}
{{--            font-weight: bold;--}}
{{--            color: #333;--}}
{{--            margin: 20px 0;--}}
{{--            padding: 10px;--}}
{{--            background-color: #f9f9f9;--}}
{{--            border: 1px solid #ddd;--}}
{{--            display: inline-block;--}}
{{--            border-radius: 5px;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="email-container">--}}
{{--    <div class="logo-background"></div>--}}
{{--    <div class="email-content">--}}
{{--        <h1>Verify Your Email</h1>--}}
{{--        <p>Please use the code below to verify your email address:</p>--}}
{{--        <div class="verification-code">{{ $code }}</div>--}}
{{--        <p>Thank you for using our application!</p>--}}
{{--    </div>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}



<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
</head>
<body>
<h1>Verification Code</h1>
<p>Your verification code is: <strong>{{ $code }}</strong></p>
<p>Please enter this code to verify your email address.</p>
</body>
</html>
