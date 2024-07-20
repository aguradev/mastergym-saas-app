@extends('layouts.mail-template')

@section('title', 'Reminder invoice')

@section('main')
    <h4>Hi, {{ $full_name }}</h4>
    <p style="line-height: 38px;">We hope you're enjoying our services included in the <b>{{ $plan_name }} Plan</b> so
        far. this is a reminder that your payment is due soon on <b>{{ $due_date }}</b>

        To avoid any interruption in your service, please ensure that your payment is processed by the due date.

        You can make your payment by clicking the link below:
    </p>

    <div style="margin: 2rem 0; text-align: center;">
        <a href="{{ $payment_url }}"
            style="background-color: #222; 
        text-align:center; 
        text-decoration: none; 
        color: #fff;
        padding: 1rem 2rem;
        border-radius: 8px;">Payment
            Link</a>
    </div>

    <p>Best Regards,</p>
    <p>Master GYM</p>

@endsection
