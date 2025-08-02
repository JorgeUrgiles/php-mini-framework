<?php

$title = 'Proyectos';

$links = $db->query('SELECT * FROM links ORDER BY id DESC')->get();
require __DIR__ . '/../../src/links.template.php';