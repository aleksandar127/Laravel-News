<?php

namespace App;

use Illuminate\Support\Facades\Session;


class Weather
{


    public static function getLocation()
    {

        if (Session::get('location')) {
            return Session::get('location');
        }
        $query = file_get_contents(config('services.api_key.location') . $_SERVER['REMOTE_ADDR']);
        $data = json_decode($query, true);
        if ($_SERVER['REMOTE_ADDR'] === "::1" || $_SERVER['REMOTE_ADDR'] === "127.0.0.1") {
            $data["city"] = 'Belgrade';
            session(['location' => $data['city']]);
            return $data["city"];
        }
    }

    public static function getData($api)
    {
        $fileName = '../app/Weather.txt';
        if ($api) {
            $location = self::getLocation();
            $weather = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=' . $location . '&units=metric&appid=' . config("services.api_key.weather"));
            session(['weather_time' => time()]);



            $myfile = fopen($fileName, 'w');
            fwrite($myfile, $weather);
            fclose($myfile);
        }

        $weather = json_decode(file_get_contents($fileName), true);
        return $weather;
    }

    public static function check()
    {
        if (!Session::get('weather_time') || (time() - Session::get('weather_time') > 600)) {

            return true;
        }
        return false;
    }
}
