<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewCounter extends Model
{
    protected $table = 'view_counter';
    public $timestamps = false;

    public function getPageUrl()
    {
        return url()->current();
    }

    /**
     * If doesn't exist cookie with name auto-parts, we create it.
     * If cookie with name auto-parts exists, we check inside and search for current url, if it is absent we add it to the rest.
     * @return bool
     */

    public function createCookie()
    {

        if (!isset($_COOKIE["auto-parts"])){
            $visitedUrls[] = $this->getPageUrl();
            setcookie("auto-parts", json_encode($visitedUrls), time() + (86400 * 30), "/");
            $this->startCount($this->getPageUrl());

        } else {
            if (!in_array($this->getPageUrl(),json_decode($_COOKIE["auto-parts"],false, 512, JSON_BIGINT_AS_STRING))){
                $visitedUrls = json_decode($_COOKIE["auto-parts"], false, 512, JSON_BIGINT_AS_STRING);
                $visitedUrls[] = $this->getPageUrl();
                setcookie("auto-parts", json_encode($visitedUrls), time() + (86400 * 30), "/");
            } else {
                return false;
            }
        }

    }

    public function startCount($currentUrl)
    {
        $counter = new ViewCounter;
        if (isset($currentUrl)) {
            if(!$counter->where('url', $currentUrl)->first()){
                $counter->url = $currentUrl;
                $counter->count = 1;
                $counter->save();
            } else {
                $number = $counter->select('count')->where('url', $currentUrl)->first();
                $counter->count = $number + 1;
                $counter->save();
            }
        }
    }
}
