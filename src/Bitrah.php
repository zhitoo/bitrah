<?php


namespace Hshafiei374\Bitrah;

class Bitrah
{
    /**
     * @return mixed
     */
    private function login()
    {
        $post = json_encode([
            'username' => config('bitrah.username'),
            'password' => config('bitrah.password'),
        ]);

        $ch = curl_init(config('bitrah.bitrah_base_url') . 'authentication/login');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                'Content-Type: application/json',
                'accept-language: ' . config('bitrah.bitrah_gateway_language'),
                'Content-Length: ' . strlen($post)
            ]
        );

        $result = curl_exec($ch);
        $data = json_decode($result, true);

        return $data['data']['token'];
    }


    /**
     * sending request to bitrah for payment
     * @param $order_id
     * @param $rial_value
     * @param null $callback_url
     * @param null $webhook_url
     * @return mixed
     */
    public function submitRequest($order_id, $rial_value, $callback_url = null, $webhook_url = null)
    {
        $callback_url = is_null($callback_url) ? config('bitrah.call_back_url') : $callback_url;
        $webhook_url = is_null($webhook_url) ? config('bitrah.webhook_url') : $webhook_url;
        $post = json_encode([
            'orderId' => $order_id,
            'merchantId' => config('bitrah.merchant_id'),
            'rialValue' => $rial_value,
            'webhookUrl' => $webhook_url,
            'callbackUrl' => $callback_url,
        ]);
        $ch = curl_init(config('bitrah.bitrah_base_url') . config('bitrah.bitrah_submit_url'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                'Content-Type: application/json',
                'accept-language: ' . config('bitrah.bitrah_gateway_language'),
                'Content-Length: ' . strlen($post),
                'Authentication: bearer ' . $this->login(),
            ]
        );
        $result = curl_exec($ch);
        return json_decode($result, true);
    }

    /**
     * get transaction status
     * @param $refId string
     * @return mixed
     */
    public function getTransactionStatus($refId)
    {
        $post = json_encode([
            'refId' => $refId,
            'merchantId' => config('bitrah.merchant_id')
        ]);
        $ch = curl_init(config('bitrah.bitrah_base_url') . config('bitrah.bitrah_status_url'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                'Content-Type: application/json',
                'accept-language: ' . config('bitrah.bitrah_gateway_language'),
                'Content-Length: ' . strlen($post),
                'Authentication: bearer ' . $this->login(),
            ]
        );
        $result = curl_exec($ch);
        return json_decode($result, true);
    }
}
