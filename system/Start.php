<?php

namespace system;

class Start
{
    public function loadClass()
    {
        spl_autoload_register(function ($class) {
            $dir = str_replace('system', '', __DIR__);

            $file = $dir . str_replace('\\', DIRECTORY_SEPARATOR, $class . '.php');
            include_once $file;
        });
    }

    /**
     * @return void
     */
    public function start(): void
    {
        session_start();
        $url = parse_url($_SERVER['REQUEST_URI']);
        $pos = strripos($url['path'], '.');

        $class = "controller\\" . ucfirst(trim($url['path'], "/"));
        $method = "index";

        if ('/index' === $_SERVER['REQUEST_URI'] || '/' === $_SERVER['REQUEST_URI'] || empty($_SERVER['REQUEST_URI'])) {
            $class = 'controller\Task';
        }

        if ($pos !== false) {
            $result = explode('.', $url['path']);
            $class = "controller\\" . ucfirst(trim($result[0], "/"));;
            $method = $result[1];

        }

        $instance = new $class();
        $instance->$method();
    }
}
