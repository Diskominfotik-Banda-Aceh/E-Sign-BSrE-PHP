Table of contents
=================
<!--ts-->
   * [Table of contents](#table-of-contents)
   * [E-Sign BSrE](#e-sign-bsre)
      * [Instalisasi](#instalisasi)
      * [Penggunaan](#penggunaan)
        * [Kode](#kode)
      * [Changelog](#changelog)
      * [Contributing](#contributing)
      * [Keamanan](#keamanan)
      * [Credits](#credits)
      * [License](#license)
<!--te-->

# E-Sign BSrE

[![Latest Version on Packagist](https://img.shields.io/packagist/v/diskominfotik-banda-aceh/e-sign-bsre-php.svg?style=flat-square)](https://packagist.org/packages/diskominfotik-banda-aceh/e-sign-bsre-php)
[![Total Downloads](https://img.shields.io/packagist/dt/diskominfotik-banda-aceh/e-sign-bsre-php.svg?style=flat-square)](https://packagist.org/packages/diskominfotik-banda-aceh/e-sign-bsre-php)
<!--![GitHub Actions](https://github.com/diskominfotik-banda-aceh/e-sign-bsre-php/actions/workflows/main.yml/badge.svg)-->

[E-Sign BSrE](https://bsre.bssn.go.id/) adalah package untuk memudahkan penggunaan API E-Sign dari BSSN dengan bahasa PHP

## Instalisasi

Anda bisa install package via composer:

```bash
composer require diskominfotik-banda-aceh/e-sign-bsre-php
```
Jika Anda menggunakan PHP Native tambahkan baris berikut:
```php
require 'vendor/autoload.php';
```

## Penggunaan

### Kode
Kode yang disediakan ada beberapa yaitu tanda tangan digital invisible, verifikasi tanda tangan digital dan tanda tangan visible (soon)

- Tanda tangan digital invisible 
```php
$esign = new DiskominfotikBandaAceh\ESignBsrePhp\ESignBSrE($baseUrl, $username, $password);
$response = $esign->setFile($file, $filename)->sign($nik, $passphrase);
$response->getStatus(); //Get status response (int) - 404, 200 etc
$response->getErrors(); //Get error response
$response->getData(); //Get data as blob pdf
```

- Verifikasi tanda tangan digital  
```php
$esign = new DiskominfotikBandaAceh\ESignBsrePhp\ESignBSrE($baseUrl, $username, $password);
$response = $esign->setFile($file, $filename)->verification();
$response->getStatus(); //Get status response (int)
$response->getErrors(); //Get error response
$response->getData(); //Get data as array (tergantung dari API BSrE)
```

### Contoh kode mengambil file
Terdapat beberapa cara untuk mengambil file yang terdapat pada aplikasi

- Menggunakan Utils dari GuzzleHttp
```php
$file = GuzzleHttp\Psr7\Utils::tryFopen('/path/to/file.pdf', 'r')
```

- Menggunakan `file_get_contents`
```php
$file = file_get_contents('/path/to/file.pdf')
```

<!--### Testing

```bash
composer test
```
-->

### Changelog

Lihat [CHANGELOG](CHANGELOG.md) untuk informasi lebih lanjut terkait perubahan terbaru.

## Contributing

Lihat [CONTRIBUTING](CONTRIBUTING.md) untuk lebih detailnya.

### Keamanan

Jika anda menemukan masalah kerentanan keamanan pada package, tolong email ke diskominfotikbna[at]gmail.com

## Credits

-   [Maulidan Nashuha](https://github.com/maulidandev)
-   [Rayhan Yulanda](https://github.com/RayhanYulanda)
-   [Faisal Tifta Zany](https://github.com/faisalzany)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
