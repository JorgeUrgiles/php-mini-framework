<?php

$title = 'Registrar proyecto';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validator = new Validator($_POST, [
        'title'          =>'required|min:3|max:190',
        'url'            =>'required|url|max:190',
        'description'    =>'required|min:3|max:500',
    ]);
    // $title = $_POST['title'] ?? '';
    // $url = $_POST['url'] ?? '';
    // $description = $_POST['description'] ?? '';

    // $errors = [];

    // if (empty($title)) {
    //     $errors[] = 'El titulo es obligatorio.';
    // }

    // if (empty($url)) {
    //     $errors[] = 'La URL no es Obligatoria.';
    // } elseif (!filter_var($url, FILTER_VALIDATE_URL)) {
    //     $errors[] = 'La URL no es valida.';
    // }

    // if (empty($description)) {
    //     $errors[] = 'La descripcion es obligatoria';
    // }

    // if (empty($errors)) {
    //     $db->query(
    //         'INSERT INTO links (title, url, description) VALUES (:title, :url, :description)',
    //         [
    //             'title' => $title,
    //             'url' => $url,
    //             'description' => $description,
    //         ]
    //     );

    if ($validator->passes()) {
        $db->query(
            'INSERT INTO links (title, url, description) VALUES (:title, :url, :description)',
            [
                'title'         => $_POST['title'],
                'url'           => $_POST['url'],
                'description'   => $_POST['description'],
            ]
        );

        header('Location: /links');
        exit;
    } else {
        $errors = $validator->errors();
    }
}

require __DIR__ . '/../../src/links-create.template.php';