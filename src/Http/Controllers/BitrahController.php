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
        if(is_null($bitrahTransaction)){
            $message = trans('bitrah::messages.transaction_not_found');
            $refId = '';
        }else {
            $message = trans('bitrah::messages.status.' . $bitrahTransaction->status);
            $refId = $bitrahTransaction->ref_id;
        }
        return view('bitrah::show', [
            'message' => $message,
            'refId'=>$refId
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