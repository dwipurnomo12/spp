<?php

namespace App\Http\Controllers\Payment;

use App\Models\User;
use App\Models\Saldo;
use App\Models\Tagihan;
use App\Models\SaldoHistory;
use Illuminate\Http\Request;
use App\Models\RiwayatPembayaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class TripayCallbackController extends Controller
{
    protected $privateKey  = 'OfV2H-e91XZ-yT2BM-0vWez-m4DID';

    public function handle(Request $request)
    {
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $this->privateKey);

        if ($signature !== (string) $callbackSignature) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid signature',
            ]);
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return Response::json([
                'success' => false,
                'message' => 'Unrecognized callback event, no action was taken',
            ]);
        }

        $data = json_decode($json);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid data sent by tripay',
            ]);
        }

        $invoiceId = $data->merchant_ref;
        $tripayReference = $data->reference;
        $status = strtoupper((string) $data->status);

        if ($data->is_closed_payment === 1) {
            $invoice = RiwayatPembayaran::where('merchant_ref', $invoiceId)
                ->where('reference', $tripayReference)
                ->where('status', '=', 'UNPAID')
                ->first();

            if (!$invoice) {
                return Response::json([
                    'success' => false,
                    'message' => 'No invoice found or already paid: ' . $invoiceId,
                ]);
            }

            switch ($status) {
                case 'PAID':
                    $invoice->update(['status' => 'PAID']);

                    $userId     = $invoice->user_id;
                    $tagihanId  = $invoice->tagihan_id;

                    $user = User::find($userId);

                    $tagihan = Tagihan::with(['users' => function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    }])->find($tagihanId);

                    $nominal = $tagihan->users->first()->pivot->total_tagihan;

                    $saldo = Saldo::first();
                    $saldo->saldo += $nominal;
                    $saldo->save();

                    $saldoHistory = new SaldoHistory([
                        'saldo_id'      => $saldo->id,
                        'nominal'       => $nominal,
                        'keterangan'    => 'Pembayaran tagihan sekolah mandiri oleh siswa ' . $user->siswa->nm_siswa,
                        'status'        => 'in'
                    ]);
                    $saldoHistory->save();

                    $user->tagihans()->updateExistingPivot($tagihanId, [
                        'metode_pembayaran'  => 'mandiri',
                        'status'             => 'lunas'
                    ]);

                    break;

                case 'EXPIRED':
                    $invoice->update(['status' => 'EXPIRED']);
                    break;

                case 'FAILED':
                    $invoice->update(['status' => 'FAILED']);
                    break;

                default:
                    return Response::json([
                        'success' => false,
                        'message' => 'Unrecognized payment status',
                    ]);
            }

            return Response::json(['success' => true]);
        }
    }
}
