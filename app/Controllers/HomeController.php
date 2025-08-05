<?php

namespace App\Controllers;

use  Framework\Database;

class HomeController 
{
    public function index()
    {
        $db = new Database();

        $posts = $db
            ->query('SELECT * FROM posts ORDER BY id DESC LIMIT 6')
            ->get();

        require __DIR__ . '/../../src/home.template.php';
    }
}
