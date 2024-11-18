<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('reset-password.reset_password_label') }}</title>
</head>
<body style="background-color: #f3f4f6; padding: 20px; font-family: Arial, sans-serif;">
<div style="max-width: 600px; margin: 0 auto; background-color: white; border-radius: 8px; padding: 20px; box-shadow: 0 0 20px rgba(94, 100, 119, 0.4);">
    <!-- Logo -->
    <div style="text-align: center; margin-bottom: 30px;">
        <img src="{{ asset('storage/logo/logo.png') }}" alt="Logo" style="height: 50px;">
    </div>

    <!-- Content -->
    <div style="color: #374151; line-height: 1.6;">
        <h2 style="color: #111827; text-align: center; font-size: 24px; margin-bottom: 20px;">{{ __('reset-password.reset_password_label') }}</h2>

        <p>{{ __('reset-password.hello_label') }}</p>

        <p>{{ __('reset-password.description_label') }}</p>

        <!-- Reset Button -->
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $url }}"
               style="background-color: #cb1f26;
                          color: white;
                          padding: 12px 30px;
                          text-decoration: none;
                          border-radius: 6px;
                          display: inline-block;
                          font-weight: bold;">
                {{ __('reset-password.reset_password_label') }}
            </a>
        </div>

        <p>{{ __('reset-password.expire_label', ['minutes' => config('auth.passwords.users.expire', 60)]) }}</p>

        <p>{{ __('reset-password.expire_body_label') }}</p>

        <hr style="border: 0; border-top: 1px solid #e5e7eb; margin: 30px 0;">

        <p style="color: #6b7280; font-size: 14px;">{{ __('reset-password.trouble_label') }}</p>

        <p style="color: #6b7280; font-size: 14px; word-break: break-all;">
            {{ $url }}
        </p>
    </div>

    <!-- Footer -->
    <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb; text-align: center; color: #6b7280; font-size: 14px;">
        <p>© {{ date('Y') }} NS - Radio. {{ __('reset-password.all_rights_reserved_label') }}</p>
    </div>
</div>
</body>
</html>
