# A Laravel package for interacting with Vietnamese administrative units

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dilee/laravel-vietnamese-administrative-units.svg?style=flat-square)](https://packagist.org/packages/dilee/laravel-vietnamese-administrative-units)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/dilee/laravel-vietnamese-administrative-units/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/dilee/laravel-vietnamese-administrative-units/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/dilee/laravel-vietnamese-administrative-units/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/dilee/laravel-vietnamese-administrative-units/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/dilee/laravel-vietnamese-administrative-units.svg?style=flat-square)](https://packagist.org/packages/dilee/laravel-vietnamese-administrative-units)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require dilee/laravel-vietnamese-administrative-units
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-vietnamese-administrative-units-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-vietnamese-administrative-units-config"
```

This is the contents of the published config file:

```php
return [
    'province' => [
        'model' => \Dilee\VietnameseAdministrativeUnits\Models\Province::class,
        'table' => 'provinces',
    ],

    'district' => [
        'model' => \Dilee\VietnameseAdministrativeUnits\Models\District::class,
        'table' => 'districts',
    ],

    'ward' => [
        'model' => \Dilee\VietnameseAdministrativeUnits\Models\Ward::class,
        'table' => 'wards',
    ],
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-vietnamese-administrative-units-views"
```

## Usage

```php
$vietnameseAdministrativeUnits = new Dilee\VietnameseAdministrativeUnits();
echo $vietnameseAdministrativeUnits->echoPhrase('Hello, Dilee!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Dilee](https://github.com/dilee)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
