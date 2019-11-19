<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ViewCounter;
use App\CurrentCurrency;
use GuzzleHttp\Client;

class DashboardController extends Controller
{
    /**
     * Dispaly data on dashboard
     *
     * @param ViewCounter $viewCounter
     * @param CurrentCurrency $currentCurrency
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard(ViewCounter $viewCounter, CurrentCurrency $currentCurrency){
        $visitedPages = $viewCounter->all();
        $currentCurrency = $currentCurrency->all();
        return view ('admin.dashboard', compact('visitedPages', 'currentCurrency'));
    }

    /**
     * Update current currency
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCurrencyRate($id)
    {
        $client = new Client();
        $response = $client->get('https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json');
        $currencyList = json_decode($response->getBody());

        $currencyToUpdate = CurrentCurrency::find($id);
        $countryCode = $currencyToUpdate->currency_name;

        foreach ($currencyList as $key => $currency) {
            if ($countryCode == $currency->cc) {
                $currencyRate = $currency->rate;
            }
        }

        $currencyToUpdate->update([
            'rate' => $currencyRate
        ]);
        return back();
    }
}
