<?php

namespace App\Controllers;

use Framework\Validator;

class LinkController 
{
    public function index()
    {
        view('links', [
            'title' => 'Proyectos',
            'links' => db()->query('SELECT * FROM links ORDER BY id DESC')->get(),
        ]);
    }

    public function create()
    {
        view('links-create', [
            'title' => 'Registrar proyecto',
        ]);
    }

    public function store ()
    {
        $validator = new Validator($_POST, [
            'title'          =>'required|min:3|max:190',
            'url'            =>'required|url|max:190',
            'description'    =>'required|min:10|max:500',
        ]);

        if ($validator->passes()) {
            db()->query(
                'INSERT INTO links (title, url, description) VALUES (:title, :url, :description)',
                [
                    'title'         => $_POST['title'],
                    'url'           => $_POST['url'],
                    'description'   => $_POST['description'],
                ]
            );

            redirect('/links');
        }

        view('links-create', [
            'title' => 'Registrar proyecto',
            'errors' => $validator->errors(),
        ]);
    }

    public function destroy()
    {
        db()->query('DELETE FROM links WHERE id = :id', [
            'id'=> $_POST['id'] ?? null,
        ]);

        redirect('/links');
    }

    public function edit()
    {
        view('links-edit', [
            'title' => 'Editar proyecto',
            'link' =>db()->query('SELECT * FROM links WHERE id = :id', [
                    'id' => $_GET['id'] ?? null,
                ])->firstOrFail(),
        ]);
    }

    public function update()
    {
        $validator = new Validator($_POST, [
            'title'          =>'required|min:3|max:190',
            'url'            =>'required|url|max:190',
            'description'    =>'required|min:10|max:500',
        ]);

        $link = db()->query('SELECT * FROM links WHERE id = :id', [
            'id' => $_GET['id'] ?? null,
        ])->firstOrFail();


        if ($validator->passes()) {
            db()->query(
                'UPDATE links SET title = :title, url = :url, description = :description WHERE id = :id',
                [
                    'id'            => $link['id'],
                    'title'         => $_POST['title'],
                    'url'           => $_POST['url'],
                    'description'   => $_POST['description'],
                ]
            );

            redirect('/links');
        }

        view('links-edit', [
            'title' => 'Editar proyecto',
            'errors' =>  $validator->errors(),
        ]);
    }
}
