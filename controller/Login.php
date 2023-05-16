<?php

namespace controller;

use system\Output;

class Login
{
    private $output;

    public function __construct()
    {
        $this->output = new Output();
    }

    public function index()
    {
        $this->output->view('login');
    }

    public function auth()
    {
        if (isset($_POST['user']) & isset($_POST['password']) && $_POST['user'] === 'admin' && password_verify($_POST['password'], password_hash('123', PASSWORD_DEFAULT))) {
            $_SESSION['user'] = 'admin';
            header('Location: /');
            die;
        }

        header('Location: /login?error=1');
    }

    public function out()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            header('Location: /');
            die;
        }
    }
}