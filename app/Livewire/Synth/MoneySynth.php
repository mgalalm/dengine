<?php

namespace App\Livewire\Synth;

use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;
use Money\Currency;
use Money\Money;

class MoneySynth extends Synth
{

    public static $key = 'money';

    static function match($target)
    {
        return $target instanceof Money;
    }

    // dehydrate method
    public function dehydrate($value)
    {
//        return [['amount' => $value->getAmount(), 'currency' => $value->getCurrency()->getCode()],  []];
        return [$value->getAmount() , []];
    }

    // hydrate method
    public function hydrate($value)
    {
       $instance = new Money($value, new Currency('EUR'));
       return $instance->getAmount();
//       return (int) $value;
    }

//    public function get(&$target, $key)
//    {
//        return $target->{$key};
//    }
//
//    public function set(&$target, $key, $value)
//    {
//        $target->{$key} = $value;
//    }

}
