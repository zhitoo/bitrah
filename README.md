<div align="center">
    <img src="./images/logo.svg" width="200" height="200">
</div>
<h1 align="center">Bitrah Gateway Laravel Package</h1>
<h2 align="center">Package for bitrah gateway</h2>

<div align="center">

[![License: MIT](https://img.shields.io/badge/License-MIT-brightgreen.svg)](https://opensource.org/licenses/MIT)

</div>

Bitrah is a [Laravel](http://laravel.com/) package that helping Laravel developers implement [Bitrah](http://bitrah.ir/) gateway .


- [Features](#features)
- [Getting Started](#getting-started)
- [Code](#code)
- [Documentation](#documentation)
- [Changelog](#changelog)
- [License](#license)


---


## Features
* بسیار ساده و قدرتمند

## Getting Started
پکیج را با دستور زیر نصب میکنیم 
```
composer require hshafiei374/bitrah
```

اگر ورژن لاراول شما کمتر از 5.4 است باید وب هوک و کال بک را در آرایه ی $except در کلاس VerifyCsrfToken قرار دهید.


## Code
بااستفاده از کد زیر یک درخواست به بیتراه میفرستیم
```php
$result = Bitrah::submitRequest(orderId '1',rialValue '270000000', callbackurl 'http://your-domain.com/bitrah_call_back', webhookkurl 'http://your-domain.com/bitrah_webhook');
/*
$result is : 
[
'data'=>[
        'token'=>'0d0cd5a0445647asdasdcff2c48ad69e7',
        'redirectUrl'=>https://www.bitrah.ir/en/BitrahTestAccount?token=0d0cd5a044564783asc48ad69e7&mode=off&coin=BTC&amount=25000'',
        'multiCoinRedirectUrl'=>'https://www.bitrah.ir/en/BitrahTestAccount?token=0d0cd5asdcccff2c48ad69e7&mode=on&coin=BTC&amount=25000',
        'refId'=>'2547'
    ],
'message'=>'Successfully done!',
'timesatmp'=>'2020-11-14T06:56:43.646+0000',
'success'=>'true'
];
*/
```

شما باید اطلاعات گرفته شده از بیتراه را در دیتا بیس خود ذخیره کنید و چک کنید اگر قبلا refId و token در دیتا بیس شما وجود نداشته باشد.

سپس باید کاربر را به url دریافتی از بیتراه هدایت کنید.

کاربر وارد صفحه پرداخت بیتراه می شود

![Code](./images/bitrah1.jpeg)


بعد از پرداخت کاربر به لینک کالبک سایت شما باز می گردد.
در این مرحله شما باید چک کنید که این درخواست قبلا پردازش نشده باشد.

در نهایت بعد از تایید پرداخت وب هوک شما توسط بیتراه صدا زده می شود.

## Documentation
[documentation](https://www.bitrah.ir/en/doc).
## Changelog
## v1.0.0
* پیاده سازی درخواست


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
