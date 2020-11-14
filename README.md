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
* Store and Update All Transactions in data base automatically

## Getting Started
First, you should install bitrah on your Laravel project. 
```
composer require hshafiei374/bitrah
```
If use laravel < 5.4 put your webhook and callback url to VerifyCsrfToken $except array


## Code
It is easy to use.

Send a Request to Bitrah:
```php
Bitrah::submitRequest(orderId '1',rialValue '270000000', callbackurl 'http://your-domain.com/bitrah_call_back', webhookkurl 'http://your-domain.com/bitrah_webhook');
```
Then we enter the ‌Bitrah gateway 

![Code](./images/bitrah1.jpeg)

After the payment, bitrah call the callback url

And when the transaction is confirmed on the network, the web hook is executed

## Documentation
You can find more information about Bitrah in [documentation](https://www.bitrah.ir/en/doc).


## Changelog
## v1.0.0
* submit a request and update transaction status.


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
