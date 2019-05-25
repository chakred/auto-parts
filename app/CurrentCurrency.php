<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\ApiBank\BankUkrainian;

class CurrentCurrency extends Model
{
    protected $table = 'current_currency';

    public function updateCurrentCurrency(BankUkrainian $bankUkrainian)
    {
        $today = Carbon::now();

        $currentCurrency = new CurrentCurrency();

        foreach ($currentCurrency->all() as $storedCurrncy) {

            if ($bankUkrainian->chooseOneCurrency('EUR') != null && $bankUkrainian->chooseOneCurrency('EUR') != "" ) {
                if ($storedCurrncy->updated_at < $today && $storedCurrncy->currency_name === 'EUR') {
                    $euro = $currentCurrency->where('currency_name','EUR')->first();
                    $euro->rate = round($bankUkrainian->chooseOneCurrency('EUR')['rate'], 2);
                    $euro->save();
                }
            }

            if ($bankUkrainian->chooseOneCurrency('USD') != null && $bankUkrainian->chooseOneCurrency('USD') != "" ) {
                if ($storedCurrncy->updated_at < $today && $storedCurrncy->currency_name === 'USD') {
                    $euro = $currentCurrency->where('currency_name','USD')->first();
                    $euro->rate = round($bankUkrainian->chooseOneCurrency('USD')['rate'], 2);
                    $euro->save();
                }
            }
        }

    }
}
