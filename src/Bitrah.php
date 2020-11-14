<?php


namespace Hshafiei374\Bitrah;

class Bitrah
{
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
        $ch = curl_init(config('bitrah.bitrah_base_url') . 'order/submit/wr');
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
