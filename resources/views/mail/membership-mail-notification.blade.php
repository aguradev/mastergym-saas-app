@extends('layouts.tenant-mail-template')

@section('main')
    <p>Hi, {{ $full_name }} </p>

    @if ($status == 'MEMBERSHIP_ACTIVE')
        <p>Great news! Your subscription has been approved, and your membership is now officially active. We're thrilled to
            have you on board,You can check your subscription details in your dashboard</p>

        <p>If you have any questions or need assistance, we're here to help. Just reply to this email, and we'll get back to
            you ASAP.</p>

        <p>Welcome to the community—we’re excited to see what you’ll achieve!</p>
    @endif

    @if ($status == 'MEMBERSHIP_INACTIVE')
        <p>We wanted to let you know that your subscription has been deactivated.</p>
        <p>If you believe this is an error or if you’d like to reactivate your subscription, please contact our support team
            or visit your dashboard for more details.</p>
        <p>Thank you for being with us. We hope to welcome you back soon!</p>
    @endif
@endsection
