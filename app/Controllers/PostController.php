<?php

namespace App\Controllers;

use Framework\Database;

class postController 
{
    public function show()
    {
        $db = new Database();
        
        view('post', [
            'title' => 'Post',
            'post' => $db->query('SELECT * FROM posts WHERE id = :id', [
                        'id' => $_GET['id'] ?? null,
                    ])->firstOrFail(),
        ]);
    }
}
