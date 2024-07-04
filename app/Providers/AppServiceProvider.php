<?php

namespace App\Providers;

use App\Actions\Webshop\MigrateSessionCart;
use App\Factories\CartFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
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
        \Log::info('# Enter '.__METHOD__);
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                (new MigrateSessionCart())->migrate(
                    CartFactory::make(),
                    $user?->cart ?: $user->cart()->firstOrCreate()
                );
                \Log::info('# After  MSCart.migrate ');

                return $user;
            }
        });

        Blade::stringable(function (Money $money) {
           $currency = new ISOCurrencies();
           $moneyFormatter = new IntlMoneyFormatter(new \NumberFormatter('en_US', \NumberFormatter::CURRENCY), $currency);
           return $moneyFormatter->format($money);
        });
    }
}
