<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FilamentColor::register([
            'primary' => Color::hex('#ffffff'),
        ]);

        User::observe(UserObserver::class);

        LanguageSwitch::configureUsing(function (LanguageSwitch $languageSwitch) {
            $languageSwitch
                ->locales([
                    'en',
                    'ru',
                    'kk'
                ]);
        });
    }
}
