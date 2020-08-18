<?php

return [
    'bitrah_gateway_language'=>'en',
    'bitrah_submit_url'=>'https://api.bitrah.ir/api/v1/order/submit',
    'bitrah_status_url'=>'https://api.bitrah.ir/api/v1/order/status',
    'merchant_id' => '',
    'define_default_callback_url' => true,
    'define_default_webhook_url' => true,
    'default_callback_url_route_prefix'=>'bitrah',
    'default_callback_url_route'=>'/callback_url',
    'default_webhook_url_route_prefix'=>'bitrah',
    'default_webhook_url_route'=>'/webhook_url',
    'default_callback_url_route_middleware'=> ['api'] ,
    'default_webhook_url_route_middleware'=> ['api'] ,

];
