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
* Easy yet powerful.

## Getting Started
First, you should install bitrah on your Laravel project. 
پکیج را با دستور زیر نصب میکنیم
```
composer require hshafiei374/bitrah
```
If use laravel < 5.4 put your webhook and callback url to VerifyCsrfToken $except array
اگر ورژن لاراول شما کمتر از 5.4 است باید وب هوک و کال بک را در آرایه ی $except در کلاس VerifyCsrfToken قرار دهید.


## Code
It is easy to use.

Send a Request to Bitrah:
با استفاده از کد زیر یک درخواست به بیتراه میفرستیم
```php
$result = Bitrah::submitRequest(orderId '1',rialValue '270000000', callbackurl 'http://your-domain.com/bitrah_call_back', webhookkurl 'http://your-domain.com/bitrah_webhook');
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
```
you must store token and refId to your database and if exists token and refId before mean 
شما باید اطلاعات گرفته شده از بیتراه را در دیتا بیس خود ذخیره کنید و چک کنید اگر قبلا refId و token در دیتا بیس شما وجود نداشته باشد.
you must redirect to multiCoinRedirectUrl or redirectUrl
سپس باید کاربر را به url دریافتی از بیتراه هدایت کنید.
Then we enter the ‌Bitrah gateway 
کاربر وارد صفحه پرداخت بیتراه می شود

![Code](./images/bitrah1.jpeg)

After the payment, bitrah call the callback url
بعد از پرداخت کاربر به لینک callback سایت شما باز می گردد.
در این مرحله شما باید چک کنید که این درخواست قبلا پردازش نشده باشد.

And when the transaction is confirmed on the network, the web hook is executed
در نهایت بعد از تایید پرداخت وب هوک شما توسط بیتراه صدا زده می شود.

## Documentation
داکیومنت بیتراه
You can find more information about Bitrah in [documentation](https://www.bitrah.ir/en/doc).


## Changelog
## v1.0.0
* submit a request and update transaction status.


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
