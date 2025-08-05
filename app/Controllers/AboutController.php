<?php

namespace App\Controllers;

class AboutController 
{
    public function index()
    {
        $title = 'Sobre Mi';

        require __DIR__ . '/../../src/about.template.php';
    }
}
