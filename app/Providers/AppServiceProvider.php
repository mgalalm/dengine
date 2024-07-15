<?php

namespace App\Providers;

use App\Actions\Webshop\MigrateSessionCart;
use App\Factories\CartFactory;
use App\Livewire\Synth\MoneySynth;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Laravel\Fortify\Fortify;
use Livewire\Livewire;
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
        // register fortify service provider


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Cashier::calculateTaxes();
        Livewire::propertySynthesizer(MoneySynth::class);
        Blade::stringable(function (Money $money) {
           $currency = new ISOCurrencies();
           $moneyFormatter = new IntlMoneyFormatter(new \NumberFormatter('en_US', \NumberFormatter::CURRENCY), $currency);
           return $moneyFormatter->format($money);
        });
    }
}
