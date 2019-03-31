<?php

namespace App\ApiBank;


class BankUkrainian
{
    private $apiUrl = 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json';

    /**
     * @param $countryCode, type - sting, for example "USD"
     * @return array of related data
     */

    public function chooseOneCurrency($countryCode)
    {
        $currencyList = json_decode(file_get_contents($this->apiUrl), true);

        foreach ($currencyList as $key => $currency) {
            if (in_array($countryCode,$currency)) {
                return $currency;
            }
        }
    }
}
