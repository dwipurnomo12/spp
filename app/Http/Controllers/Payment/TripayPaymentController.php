<?php

namespace App\Http\Controllers\Payment;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TripayPaymentController extends Controller
{
    public function getPaymentChannels()
    {
        $apiKey  = config('tripay.api_key');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response)->data;

        return $response ? $response : $error;
    }

    public function requestTransaction($tagihanId, $method)
    {
        $apiKey       = config('tripay.api_key');
        $privateKey   = config('tripay.private_key');
        $merchantCode = config('tripay.merchant_kode');
        $merchantRef  = 'TRX-' . time();

        $tagihan = Tagihan::with(['users' => function ($query) {
            $query->where('user_id', auth()->user()->id);
        }])
            ->findOrFail($tagihanId);

        $amount = $tagihan->users->first()->pivot->total_tagihan;

        $data = [
            'method'         => $method,
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => auth()->user()->name,
            'customer_email' => auth()->user()->email,
            'order_items'    => [],
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey)
        ];

        foreach ($tagihan->biayas as $biaya) {
            $data['order_items'][] = [
                'name'     => $biaya->jenis_pembayaran,
                'price'    => $biaya->biaya,
                'quantity' => 1,
            ];
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        // return $response ? $response : $error;
        echo empty($error) ? $response : $error;
    }
}
