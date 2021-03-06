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

        if(!empty(json_decode(file_get_contents($this->apiUrl, false), true))) {
            $currencyList = json_decode(file_get_contents($this->apiUrl, false), true);
            foreach ($currencyList as $key => $currency) {
                if (in_array($countryCode,$currency)) {
                    return $currency;
                }
            }
        } else {
            return false;
        }
    }
}
