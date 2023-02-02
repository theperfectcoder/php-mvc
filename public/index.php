<?php

use App\Controllers\HomeController;

require_once "../vendor/autoload.php";

$request = $_SERVER['REQUEST_URI'];
$array = explode("/", $request);
$id = intval(end($array));


$router = [
    "/api/get-all" => 'HomeController@getAll',
    "/api/generate" => 'HomeController@generate',
    "/api/retrieve/$id" => 'HomeController@retrieve',
    "/api/update/$id" => 'HomeController@update',
    "/api/delete/$id" => 'HomeController@delete',
];

/**
 * @param $router
 * @param $requestUri
 * @return bool
 */
function checkRouting($router, $requestUri): bool
{
    if (isset($router[$requestUri]))
    {
        return true;
    }

    return false;
}

$home = new HomeController();
if (checkRouting($router, $request))
{

    if ($request == '/api/get-all')
    {
        $home->getAll();
    }

    if ($request == '/api/generate')
    {
        $home->generate();
    }

    if ($request == "/api/retrieve/$id")
    {
        $home->retrieve($id);
    }

    if ($request == "/api/update/$id")
    {
        $home->update($id);
    }

    if ($request == "/api/delete/$id")
    {
        $home->delete($id);
    }

} else {
    $home->errorNotFound();
}