<?php

$posts = $db->query('SELECT * FROM posts ORDER BY id DESC LIMIT 6')->get();

require __DIR__ . '/../../src/home.template.php';