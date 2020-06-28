<?php

namespace App;

use App\Locator;
use Illuminate\Support\Facades\Session;


class Weather
{
    private $loc;

    public function __construct(Locator $locator)
    {
        $this->loc = $locator->location;
    }

    public function getData()
    {
        $api = $this->check();
        $fileName = '../app/Weather.txt';
        if ($api) {
            $location = $this->loc;
            $weather = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=' . $location . '&units=metric&appid=' . config("services.api_key.weather"));
            session(['weather_time' => time()]);



            $myfile = fopen($fileName, 'w');
            fwrite($myfile, $weather);
            fclose($myfile);
        }

        $weather = json_decode(file_get_contents($fileName), true);
        return $weather;
    }

    public function check()
    {
        if (!Session::get('weather_time') || (time() - Session::get('weather_time') > 600)) {

            return true;
        }
        return false;
    }
}
