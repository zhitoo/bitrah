<?php


namespace Hshafiei374\Bitrah;


use Hshafiei374\Bitrah\Models\BitrahTransaction;

class Bitrah
{

    /**
     * @param array $params string
     * @param string $type
     * @return mixed
     */
    private function sendRequestToBitrah(array $params, string $type = 'Submit')
    {
        $params = json_encode($params);
        $submitUrl = $type == 'Submit' ? config('bitrah.bitrah_submit_url') : config('bitrah.bitrah_status_url');
        $method = "POST";
        $headers = [
            "content-type:application/json",
            "Accept-Language:" . config('bitrah.bitrah_gateway_language'),
            "Content-Length:" . strlen($params)
        ];
        $ch = curl_init($submitUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            $headers
        );
        $result = curl_exec($ch);
        return json_decode($result, true);
    }

    public function submitRequest($order_id, $rial_value, $callback_url = '', $webhook_url = '')
    {

        if (empty($callback_url) && config('bitrah.define_default_callback_url')) {
            $callback_url = route('bitrah.callback');
        }
        if (empty($webhook_url) && config('bitrah.define_default_webhook_url')) {
            $webhook_url = route('bitrah.webhook');
        }
        $merchantId = config('bitrah.merchant_id');
        if (empty($merchantId)) {
            throw new \Exception('Merchant ID is required');
        }
        $data = array(
            'merchantId' => config('bitrah.merchant_id'),
            'orderId' => $order_id,
            'rialValue' => $rial_value,
            'callbackUrl' => $callback_url,
            'webhookUrl' => $webhook_url
        );
        $response = $this->sendRequestToBitrah($data, 'Submit');
        if (!$response['success']) {
            throw new \Exception($response['message']);
        }
        $multiCoinRedirectUrl = $response['data']['multiCoinRedirectUrl'];
        $bitrahTransaction = new BitrahTransaction();
        $bitrahTransaction->token = $response['data']['token'];
        $bitrahTransaction->ref_id = $response['data']['refId'];
        $bitrahTransaction->order_id = $order_id;
        $bitrahTransaction->rial_value = $rial_value;
        $bitrahTransaction->callback_url = $callback_url;
        $bitrahTransaction->webhook_url = $webhook_url;
        $bitrahTransaction->status = "0";
        $bitrahTransaction->save();
        header('Location: ' . $multiCoinRedirectUrl);
        exit();
    }

    public function updateTransactionStatus($refId)
    {
        if (empty($callback_url) && config('bitrah.define_default_callback_url')) {
            $callback_url = route('bitrah.callback');
        }
        if (empty($webhook_url) && config('bitrah.define_default_webhook_url')) {
            $webhook_url = route('bitrah.webhook');
        }
        $merchantId = config('bitrah.merchant_id');
        if (empty($merchantId)) {
            throw new \Exception('Merchant ID is required');
        }
        $data = array(
            'merchantId' => config('bitrah.merchant_id'),
            'refId' => $refId,
        );
        $response = $this->sendRequestToBitrah($data, 'Status');
        if (!$response['success']) {
            throw new \Exception($response['message']);
        }
        $bitrahTransaction = BitrahTransaction::where('ref_id', $refId)->first();
        if(!is_null($bitrahTransaction)){
            $bitrahTransaction->status = $response['data']['status'];
            $bitrahTransaction->coin = $response['data']['coin'];
            $bitrahTransaction->value = $response['data']['value'];
            $bitrahTransaction->save();
        }
        return $bitrahTransaction;
    }
}
