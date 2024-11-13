<?php

return [
    App\Providers\AppServiceProvider::class,
//    App\Providers\FilamentThemeServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    \SocialiteProviders\Manager\ServiceProvider::class, // add
];
