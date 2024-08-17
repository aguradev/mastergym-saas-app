@extends('layouts.tenant-mail-template')

@section('main')
    <h2 class="text-center">Thank you for your order</h2>
    <p class="text-center" style="color: #aaa">Here is a summary for the transaction, and wait information for approved our
        staff</p>
    <hr style="margin-top: 2.2rem" />

    <h4 style="margin-bottom: 2rem">Invoice #{{ $invoice_id }}</h4>

    <div style="margin-bottom: 2rem">
        <h4 style="margin-bottom: .775rem">Full name</h4>
        <p>{{ $full_name }}</p>
    </div>

    <hr style="margin-top: 2.2rem" />

    <div style="margin-bottom: 2rem">
        <h4 style="margin-bottom: .775rem">Plan Purchase</h4>
        <p>{{ $membership_plan->title }}</p>
    </div>
    <div style="margin-bottom: 2rem">
        <h4 style="margin-bottom: .775rem">Period Type</h4>
        <p>{{ $membership_plan->period_type }}</p>
    </div>

    <div style="margin-bottom: 2rem">
        <h4 style="margin-bottom: .775rem">Tax</h4>
        <p>IDR {{ number_format($tax) }}</p>
    </div>

    <div style="margin-bottom: 2rem">
        <h4 style="margin-bottom: .775rem">Price</h4>
        <p>IDR {{ number_format($membership_plan->amount) }}</p>
    </div>

    <hr style="margin-bottom: 2.2rem" />

    <table style="width: 100%; margin-bottom: 1.5rem">
        <tr>
            <td style="font-size: 1.6rem; font-weight: 700; color: #aaa">Total</td>
            <td style="text-align: right; color: green; font-weight: 700; font-size: 1.4rem">IDR
                {{ number_format($total) }}</td>
        </tr>
    </table>

    <p style="line-height: 28px; font-size: 1rem;">Disclaimer: Attached is the invoice for the services provided by
        the outlet. For
        items not covered in the
        attached invoice, the outlet shall be responsible to issue an invoice directly to you.</p>
@endsection
