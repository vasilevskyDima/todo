<?php

namespace controller;

class Login extends BaseController
{
    /**
     * @return void
     */
    public function index(): void
    {
        $this->output->view('login');
    }

    /**
     * @return void
     */
    public function auth(): void
    {
        if (isset($_POST['user']) & isset($_POST['password']) && $_POST['user'] === 'admin' && password_verify($_POST['password'], password_hash('123', PASSWORD_DEFAULT))) {
            $_SESSION['user'] = 'admin';
            header('Location: /');
            die;
        }

        header('Location: /login?error=1');
    }

    /**
     * @return void
     */
    public function logaut(): void
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            header('Location: /');
            die;
        }
    }
}