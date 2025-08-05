<?php

if(!function_exists('root_path')) {
    function root_path(string $path)
    {
        return dirname(__DIR__) . '/' . normalize_path($path);
    }
}

if(!function_exists('normalize_path')) {
    function normalize_path(string $path)
    {
        return trim($path, '/');
    }
}


if (!function_exists('view')) {
    function view(string $view, array $data = []){
        
        extract($data);

        $filePath = root_path("src/{$view}.template.php");

        require $filePath;
    }

if (!function_exists('tint_slected_nav_item')) {
    function tint_slected_nav_item(string $url) {
        if ($_SERVER['REQUEST_URI'] === $url) {
            return true;
        }

        return false;
    }
}

if (!function_exists('set_input_value')) {
 function set_input_value (string $value) {
    return $_POST[$value] ?? '';
 }
}

}