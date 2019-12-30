<?php

namespace App\Calculation;
use App\CurrentCurrency;

class PriceCalculation
{
    /**
     * Calculate cost according to currency rate, discount and profit
     *
     * @param $goods
     * @return mixed
     */
    public  function calculate($goods)
    {
        $currentCurrency = new CurrentCurrency();
        if (isset($goods)) {
            foreach ($goods as $good) {
                $good->fixedRateAtDate = $currentCurrency->rate($good->currency)->rate;

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
                        $currency = $currentCurrency->rate($good->currency);
                        $good->convertedPrice = round($good->convertedPrice*$currency->rate);
                        break;
                    case 'USD':
                        $currency = $currentCurrency->rate($good->currency);
                        $good->convertedPrice = round($good->convertedPrice*$currency->rate);
                        break;
                }
            }
            return $goods;
        }
    }

    /**
     * Calculate profit
     *
     * @param $good
     * @return float|int
     */
    private function includeProfit($good)
    {
        $percentOfProfit = $good->cost/100*$good->profit;
        return $good->cost+$percentOfProfit;
    }

    /**
     * Calculate discount
     *
     * @param $good
     * @return float|int
     */
    private function includeDiscount($good)
    {
        $percentOfDiscount = $good->convertedPrice/100*$good->discount;
        return $good->convertedPrice-$percentOfDiscount;
    }

    public function calculateSingle($relatedGoods)
    {
        $currentCurrency = new CurrentCurrency();
        if (isset($relatedGoods->profit) && $relatedGoods->profit != null) {
            $percentOfProfit = $relatedGoods->cost/100*$relatedGoods->profit;
            $relatedGoods->convertedPrice = $relatedGoods->cost+$percentOfProfit;
        } else {
            $relatedGoods->convertedPrice = $relatedGoods->cost;
        }
        if (isset($relatedGoods->discount) && $relatedGoods->discount != null) {
            $percentOfDiscount = $relatedGoods->convertedPrice/100*$relatedGoods->discount;
            $relatedGoods->convertedPrice = $relatedGoods->convertedPrice-$percentOfDiscount;
        }

        switch($relatedGoods->currency) {
            case 'EUR':
                $currency = $currentCurrency->rate($relatedGoods->currency);
                $relatedGoods->convertedPrice = round($relatedGoods->convertedPrice*$currency->rate);
                break;
            case 'USD':
                $currency = $currentCurrency->rate($relatedGoods->currency);
                $relatedGoods->convertedPrice = round($relatedGoods->convertedPrice*$currency->rate);
                break;
        }

        return $relatedGoods;
    }
}
