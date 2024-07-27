@extends('layouts.mail-template')

@section('main')
    <h2 class="text-center">Tenant Registration</h2>

    <p style="line-height: 38px;">Hi, <b>{{ $full_name ?? 'User' }}</b> We are excited to have you as a new tenant. To
        ensure a
        smooth move in-process, please
        complete registration by following the step bellow.</p>

    <p>Fill out the registration form by clicking the link below</p>

    <div style="margin: 3rem 0; text-align: center;">
        <a href="{{ $url }}"
            style="background-color: #222; 
        text-align:center; 
        text-decoration: none; 
        color: #fff;
        padding: 1rem 2rem;
        border-radius: 8px;">Set
            up your tenant</a>
    </div>
@endsection
