<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;


class CurrencyController extends Controller
{


    public static $dir = '../app/ExchangeRates/Currency';


    public function index()
    {
        $list = self::getData(self::check());
        return view('currency.index', ['currency' => $list['result']]);
    }

    public static function check()
    {
        if (file_exists(self::setPath())) {
            return false;
        }
        return true;
    }

    public static function getData($api)
    {
        if ($api) {
            $path = '../app/ExchangeRates';
            $files = File::files($path);
            File::delete($files);

            $list = file_get_contents("https://api.kursna-lista.info/" . config('services.api_key.currency') . "/kursna_lista/json");

            if (!file_exists(self::setPath())) {
                $myfile = fopen(self::setPath(), 'w');
                fwrite($myfile, $list);
                fclose($myfile);
            }
            $list = json_decode($list, true);
        } else {
            $list = json_decode(file_get_contents(self::setPath()), true);
        }
        return $list;
    }

    public static function setPath()
    {
        return self::$dir . date("Y-m-d") . '.txt';
    }
}
