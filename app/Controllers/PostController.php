<?php

namespace App\Controllers;

use Framework\Database;

class postController 
{
    public function show()
    {
        $db = new Database();

        $title = 'Post';

        $post = $db->query('SELECT * FROM posts WHERE id = :id', [
            'id' => $_GET['id'] ?? null,
        ])->firstOrFail();

        require __DIR__ . '/../../src/post.template.php';  
    }
}
