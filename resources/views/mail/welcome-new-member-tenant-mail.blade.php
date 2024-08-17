@extends('layouts.tenant-mail-template')

@section('main')
    <h2 class="text-center">Welcome!</h2>
    <p>Dear, {{ $username }}, </p>
    <p>Thank you for joining our gym. before you can access all our feature.
        please purchasing
        member subscription in dashboard.</p>
@endsection
