<?php

namespace Hshafiei374\Bitrah\Events;

use Hshafiei374\Bitrah\Models\BitrahTransaction;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
class UpdateBitrahTransactionStatusEvent
{
    use Dispatchable, SerializesModels;
    public $bitrahTransaction;

    public function __construct(BitrahTransaction $bitrahTransaction)
    {
        $this->bitrahTransaction = $bitrahTransaction;
    }

}