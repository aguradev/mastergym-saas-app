<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransHelper
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$curlOptions[CURLOPT_SSL_VERIFYHOST] = 0;
        Config::$curlOptions[CURLOPT_SSL_VERIFYPEER] = 0;
        Config::$curlOptions[CURLOPT_HTTPHEADER] = [];
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
                "price" => $request["total"],
                "quantity" => 1
            ]
        ];

        $customer_details = [
            "first_name" => $request["full_name"],
            "email" => $request["email"],
            "phone" => $request["phone_number"],
            "billing_address" => $request["address"]
        ];

        $transaction_data = [
            "transaction_details" => $transaction_details,
            "item_details" => $items,
            "customer_details" => $customer_details
        ];

        try {
            $paymentUrl = Snap::createTransaction($transaction_data)->redirect_url;

            return $paymentUrl;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }
}
