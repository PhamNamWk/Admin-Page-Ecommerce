<?php

use eftec\bladeone\BladeOne;

if (!function_exists('view')) {
    function view($view, $data = [])
    {
        $views = __DIR__ . '/views';
        $cache = __DIR__ . '/storage/compiles';
        $blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG);
        echo $blade->run($view, $data);
    }
};
if (!function_exists('redirect')) {
    function redirect($path)
    {
        header('location:' . $path);
    }
};
if (!function_exists('file_url')) {
    function file_url($path)
    {
        if (!file_exists($path)) {
            return null;
        }
        return $_ENV['BASE_URL'] . $path;
    }
}
