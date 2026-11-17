<?php

namespace JeffersonGoncalves\Filament\GdprDsar\Tests\Fixtures;

use Filament\Panel;
use Filament\PanelProvider;
use JeffersonGoncalves\Filament\GdprDsar\GdprDsarPlugin;

class TestPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->plugins([
                GdprDsarPlugin::make(),
            ]);
    }
}
