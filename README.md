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

## Penggunaan

### Kode
Kode yang disediakan ada beberapa yaitu tanda tangan digital invisible, verifikasi tanda tangan digital dan tanda tangan visible (soon)

- Tanda tangan digital invisible 
```php
$esign = new ESignBSrE();
$esign->signInvisible($nik, $passphrase, $file, $filename);
```

- Verifikasi tanda tangan digital  
```php
$esign = new ESignBSrE();
$esign->signVerification($file, $fileName)
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
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
