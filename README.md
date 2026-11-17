<div class="filament-hidden">

![Filament GDPR DSAR](https://raw.githubusercontent.com/jeffersongoncalves/filament-gdpr-dsar/1.x/art/jeffersongoncalves-filament-gdpr-dsar.png)

</div>

# Filament GDPR DSAR

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/filament-gdpr-dsar.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-gdpr-dsar)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-gdpr-dsar/tests.yml?branch=1.x&label=tests&style=flat-square)](https://github.com/jeffersongoncalves/filament-gdpr-dsar/actions?query=workflow%3Atests+branch%3A1.x)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-gdpr-dsar/fix-php-code-style-issues.yml?branch=1.x&label=code%20style&style=flat-square)](https://github.com/jeffersongoncalves/filament-gdpr-dsar/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3A1.x)
[![Total Downloads](https://img.shields.io/packagist/dt/jeffersongoncalves/filament-gdpr-dsar.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-gdpr-dsar)
[![License](https://img.shields.io/packagist/l/jeffersongoncalves/filament-gdpr-dsar.svg?style=flat-square)](LICENSE.md)

A Filament panel for GDPR data subject requests (Arts. 15 to 22). It is the UI of [laravel-gdpr-dsar](https://github.com/jeffersongoncalves/laravel-gdpr-dsar): every action calls that package, so the rules it enforces (verify first, automatic types only, one-month deadline) stay in one place.

## Features

- Register a request for access, rectification, erasure, restriction, portability, objection or automated decisions. The deadline is set from `gdpr-dsar.deadline` (one month).
- **Extend** a complex request once by two further months, with the reason you give the data subject (Art. 12(3)).
- **Verify identity:** link the request to the data subject's record. Nothing is exported or erased before this.
- **Fulfil** access and portability (JSON export, downloadable from the request) and erasure (anonymizes the subject's records).
- **Complete** the rights answered by hand (confirmation, correction, sharing information...) with the response you gave, or **reject** with a reason.
- Overdue requests in red, an "Overdue" filter, and a navigation badge with open requests (red when one is overdue).
- 19 languages.

## Compatibility

| Plugin Version                                                          | Filament |
|-------------------------------------------------------------------------|----------|
| [1.x](https://github.com/jeffersongoncalves/filament-gdpr-dsar/tree/1.x) | 3.x      |
| [2.x](https://github.com/jeffersongoncalves/filament-gdpr-dsar/tree/2.x) | 4.x      |
| [3.x](https://github.com/jeffersongoncalves/filament-gdpr-dsar/tree/3.x) | 5.x      |

## Installation

You can install the package via composer:

```bash
composer require jeffersongoncalves/filament-gdpr-dsar:"^1.0"
php artisan vendor:publish --tag="gdpr-dsar-migrations"
php artisan migrate
```

Set up [laravel-gdpr](https://github.com/jeffersongoncalves/laravel-gdpr) first: the models listed in `gdpr.models` are the ones a request can be linked to, exported and erased.

## Usage

```php
use JeffersonGoncalves\Filament\GdprDsar\GdprDsarPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            GdprDsarPlugin::make()
                ->navigationGroup('GDPR')                 // default: no group
                ->navigationSort(10)
                ->navigationIcon('heroicon-o-shield-check')
                ->slug('data-subject-requests')
                ->subjectModels([User::class]),           // default: gdpr.models
        ]);
}
```

All fluent methods are optional. The export disk and the deadline are configured in laravel-gdpr-dsar's `gdpr-dsar` config. Keep the export disk private: the file holds the data subject's personal data.

> The resource has no authorization of its own: register it only on panels whose users handle privacy requests, or add a policy for `JeffersonGoncalves\GdprDsar\Models\DataSubjectRequest`.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jefferson Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
