<?php

namespace Hshafiei374\Bitrah\Http\Controllers;

use Hshafiei374\Bitrah\Bitrah;
use Hshafiei374\Bitrah\Models\BitrahTransaction;
use Illuminate\Http\Request;

class BitrahController extends Controller
{
    private $bitrah;

    public function __construct()
    {
        $this->bitrah = new Bitrah();
    }

    public function callBack(Request $request)
    {
        $bitrahTransaction = $this->bitrah->updateTransactionStatus($request->refId);
        return view('bitrah::show', [
            'transaction' => $bitrahTransaction
        ]);
    }

    public function webHook(Request $request)
    {
        $bitrahTransaction = $this->bitrah->updateTransactionStatus($request->refId);
        return response()->json([
            'refId' => $bitrahTransaction->ref_id,
            'orderId' =>  $bitrahTransaction->order_id,
            'status' => $bitrahTransaction->status
        ],200);
    }
}
