<?php

namespace Hshafiei374\Bitrah\Events;

use Hshafiei374\Bitrah\Models\BitrahTransaction;
use Illuminate\Queue\SerializesModels;
class UpdateBitrahTransactionStatusEvent
{
    use SerializesModels;
    public $bitrahTransaction;

    public function __construct(BitrahTransaction $bitrahTransaction)
    {
        $this->bitrahTransaction = $bitrahTransaction;
    }

}