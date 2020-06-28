<?php

namespace App;

use Illuminate\Support\Facades\Session;


class Locator
{

    public $location;
    public function __construct()
    {

        if (Session::get('location')) {
            $this->location = Session::get('location');
            return;
        }
        $query = file_get_contents(config('services.api_key.location') . $_SERVER['REMOTE_ADDR']);
        $data = json_decode($query, true);
        if ($_SERVER['REMOTE_ADDR'] === "::1" || $_SERVER['REMOTE_ADDR'] === "127.0.0.1") {
            $data["city"] = 'Belgrade';
            session(['location' => $data['city']]);
            $this->location = $data["city"];
        }
    }
}
