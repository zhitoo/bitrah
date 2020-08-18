<?php

return [
    /**
     * bitrah_gateway_language => 'fa' or 'en'
     */
    'bitrah_gateway_language'=>'en',

    /**
     * bitrah submit url
     */
    'bitrah_submit_url'=>'https://api.bitrah.ir/api/v1/order/submit',

    /**
     * bitrah get transaction status url
     */
    'bitrah_status_url'=>'https://api.bitrah.ir/api/v1/order/status',

    /**
     * your merchant id in bitrah
     */
    'merchant_id' => '',

    /**
     * if false you must create an callback url
     */
    'define_default_callback_url' => true,

    /**
     * if false you must create an webhook url
     */
    'define_default_webhook_url' => true,

    /**
     * /[-->bitrah<--]/callback_url
     */
    'default_callback_url_route_prefix'=>'bitrah',

    /**
     * callback url
     */
    'default_callback_url_route'=>'/callback_url',

    /**
     * /[-->bitrah<--]/webhook_url
     */
    'default_webhook_url_route_prefix'=>'bitrah',

    /**
     * webhook url
     */
    'default_webhook_url_route'=>'/webhook_url',

    /**
     * callback middleware for default route
     */
    'default_callback_url_route_middleware'=> [] , // ['api']

    /**
     * webhook middleware for default route
     */
    'default_webhook_url_route_middleware'=> [] , // ['api']

];
