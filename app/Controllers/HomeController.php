<?php

namespace App\Controllers;

class HomeController 
{
    public function index()
    {        
        view('home', [
            'posts' => db()->query('SELECT * FROM posts ORDER BY id DESC LIMIT 6')
                ->get(),
        ]);
    }
}
