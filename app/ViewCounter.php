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
     * @return method of counting
     */

    public function createCookie()
    {
        if (!isset($_COOKIE["auto-parts"]))  {
            $visitedUrls[] = $this->getPageUrl();
            setcookie("auto-parts", json_encode($visitedUrls), time() + (86400 * 30), "/");
            $this->startCount($this->getPageUrl());
        } else {
            if (!in_array($this->getPageUrl(),json_decode($_COOKIE["auto-parts"],false, 512, JSON_BIGINT_AS_STRING))) {
                $visitedUrls = json_decode($_COOKIE["auto-parts"], false, 512, JSON_BIGINT_AS_STRING);
                $visitedUrls[] = $this->getPageUrl();
                setcookie("auto-parts", json_encode($visitedUrls), time() + (86400 * 30), "/");
                $this->startCount($this->getPageUrl());
            }
        }
        return $this->getViewNumbers($this->getPageUrl());
    }

    /**
     * If url doesn't exist in DB, it is created.
     * if url exists i DB, the number is updated.
     *
     * @param $currentUrl
     */

    public function startCount($currentUrl)
    {
        $counter = new ViewCounter;
        if (isset($currentUrl)) {
            if (!$counter->where('url', $currentUrl)->first()) {
                $counter->url = $currentUrl;
                $counter->count = 1;
                $counter->save();
            } else {
                $number = $counter->where('url', $currentUrl)->first();
                $updatedNumber = $number->count + 1;
                $number->count = $updatedNumber;
                $number->save();
            }
        }
    }

    /**
     * Select form DB current url - view number
     * @param $currentUrl
     * @return view number
     */

    public function getViewNumbers($currentUrl)
    {
        $counter = new ViewCounter;
        if (isset($counter->where('url', $currentUrl)->first()->count)) {
            return $counter->where('url', $currentUrl)->first()->count;
        } else {
            return 0;
        }
    }
}
