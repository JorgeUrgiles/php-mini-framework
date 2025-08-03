<?php

class BlogController 
{
    public function index()
    {
        $title = 'Blog';

        require __DIR__ . '/../../src/blog.template.php';
    }
}