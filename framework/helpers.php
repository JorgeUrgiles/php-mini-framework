<?php

use Framework\Database;
use Framework\SessionManager;

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
}

if (!function_exists('tint_slected_nav_item')) {
    function tint_slected_nav_item(string $url) {
        if ($_SERVER['REQUEST_URI'] === $url) {
            return true;
        }

        return false;
    }
}

if (!function_exists('old')) {
    function old(string $key, mixed $default = null) {
        $key = 'old_' . $key;
        return session()->getFlash($key, $default);
    }
}

if (!function_exists('config')) {
    function config(string $key, mixed $default = null) {
        $config = require root_path('config/app.php');

        return $config[$key] ?? $default;
    }
}

if (!function_exists('redirect')) {
    function redirect(string $uri, string|null $message = null, int $status = 302) 
    {
        if ($message) {
            session()->setFlash('message', $message);
        }

        http_response_code($status);

        header("Location: /" . normalize_path($uri));
        exit;
    }
}

if (!function_exists('db')) {
    function db(): Database 
    {
        static $db = null;
        
        if($db === null) {
            $db = new Database();
        }
        return $db;
    }
}

if (!function_exists('isAuthenticated')) {
    function isAuthenticated()
    {
        return (bool) ($_SESSION['user'] ?? false);
    }
}

if (!function_exists('back'))
{
    function back (): void
    {
        header('Location: ' . $_SERVER['HTTP_REFERER'] ?? '/');
        exit;
    }
}

if (!function_exists('session'))
{
    function session (): SessionManager
    {
       return new SessionManager();
    }
}

if (!function_exists('errors'))
{
    function errors (): string
    {
       $errors = session()->getFlash('errors') ?? [];

        if (empty($errors)) {
        return '';
       }

       if (!is_array($errors)) {
        $errors = [$errors];
       }

       $html = '<ul class="mt-4 text-red-500">';

         foreach($errors as $error) {
            $html .= "<li class='text-xs'>&rarr; {$error}</li>";
        }

        $html .= '</ul>';

        return $html;
    }
    
}

if (!function_exists('alert'))
{
    function alert ()
    {
        $message =  session()->getFlash('message');

        if (!$message) {
            return '';
        }

        return <<<HTML
        <div class="bg-blue-100 border border-blue-400 text-blue-700 text-xs px-2 py-1 rounded mb-4">
            <strong class="font-bold">&rarr;</strong>
            {$message}
        </div>
        HTML;
    }
}