<?php

namespace App\Controllers;

use App\Models\DB;
use App\Views\JsonView;

class HomeController
{

    /**
     * @return void
     */
    public function getAll()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data = DB::getAll('random_numbers');
            JsonView::render($data);
        } else {
            $message = "Method {$_SERVER['REQUEST_METHOD']} not supported for this route";
            JsonView::render($message);
        }
    }

    /**
     * @param int $id
     * @return void
     */
    public function retrieve(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data = DB::getById('random_numbers', $id);
            JsonView::render($data);
        } else {
            $message = "Method {$_SERVER['REQUEST_METHOD']} not supported for this route";
            JsonView::render($message);
        }
    }

    /**
     * @return void
     */
    public function generate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $add = DB::insertData('random_numbers');
            $message = $add;
        } else {
            $message = "Method {$_SERVER['REQUEST_METHOD']} not supported for this route";
        }
        JsonView::render($message);
    }

    /**
     * @param int $id
     * @return void
     */
    public function update(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $add = DB::updateData($id);
            $message = $add;
        } else {
            $message = "Method {$_SERVER['REQUEST_METHOD']} not supported for this route";
        }
        JsonView::render($message);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $add = DB::deleteData($id);
            $message = $add;
        } else {
            $message = "Method {$_SERVER['REQUEST_METHOD']} not supported for this route";
        }
        JsonView::render($message);
    }

    /**
     * @return void
     */
    public function errorNotFound()
    {
        $message = "Route not found";
        JsonView::render($message);
    }
}