<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;

class MidtransHelper
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
    }

    public function createInvoiceTransaction(array $request)
    {
        $transaction_details = [
            "order_id" => time(),
            "gross_amount" => $request["total"],
        ];

        $items = [
            [
                "id" => $request["item_id"],
                "name" => $request["item_name"],
                "price" => $request["item_price"],
            ]
        ];

        $transaction_data = [
            "transaction_details" => $transaction_details,
            "item_details" => $items,
        ];

        try {
            $paymentUrl = \Midtrans\Snap::createTransaction($transaction_data)->redirect_url;

            return $paymentUrl;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }
}
