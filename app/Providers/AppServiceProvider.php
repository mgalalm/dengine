<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;


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
        Blade::stringable(function (Money $money) {
           $currency = new ISOCurrencies();
           $moneyFormatter = new IntlMoneyFormatter(new \NumberFormatter('en_US', \NumberFormatter::CURRENCY), $currency);
           return $moneyFormatter->format($money);
        });
    }
}
