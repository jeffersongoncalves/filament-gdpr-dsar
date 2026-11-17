<?php

namespace JeffersonGoncalves\Filament\GdprDsar;

use JeffersonGoncalves\FilamentPluginCore\BasePackageServiceProvider;
use Spatie\LaravelPackageTools\Package;

class GdprDsarServiceProvider extends BasePackageServiceProvider
{
    public static string $name = 'filament-gdpr-dsar';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasTranslations();
    }
}
