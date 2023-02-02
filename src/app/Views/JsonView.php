<?php

namespace App\Views;

class JsonView
{

    /**
     * @param $data
     * @return void
     */
    public static function render($data)
    {
        die(json_encode($data));
    }
}
