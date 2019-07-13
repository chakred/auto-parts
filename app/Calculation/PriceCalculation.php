<?php

namespace App\Calculation;
use App\ApiBank\BankUkrainian;

class PriceCalculation
{
    public  function calculate($goods)
    {
        $apiBank = new BankUkrainian();
        if (isset($goods)) {
            foreach ($goods as $good) {
                if (isset($good->profit) && $good->profit != null) {
                    $good->convertedPrice = $this->includeProfit($good);
                } else {
                    $good->convertedPrice = $good->cost;
                }
                if (isset($good->discount) && $good->discount != null) {
                    $good->convertedPrice = $this->includeDiscount($good);
                }

                switch($good->currency) {
                    case 'EUR':
                        $apiCurrency = $apiBank->chooseOneCurrency($good->currency);
                        $good->convertedPrice = round($good->convertedPrice*$apiCurrency['rate']);
                        break;
                    case 'USD':
                        $apiCurrency = $apiBank->chooseOneCurrency($good->currency);
                        $good->convertedPrice = round($good->convertedPrice*$apiCurrency['rate']);
                        break;
                }
            }
            return $goods;
        }
    }
    /**
     * @param $good
     * @return float|int
     */
    public function includeProfit($good)
    {
        $percentOfProfit = $good->cost/100*$good->profit;
        return $good->cost+$percentOfProfit;
    }

    /**
     * @param $good
     * @return float|int
     */
    public function includeDiscount($good)
    {
        $percentOfDiscount = $good->convertedPrice/100*$good->discount;
        return $good->convertedPrice-$percentOfDiscount;
    }
}
