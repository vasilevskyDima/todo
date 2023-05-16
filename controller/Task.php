<?php

namespace controller;

use system\Output;
use system\Pagination;

class Task
{
    private $output;

    public function __construct()
    {
        $this->output = new Output();
    }

    public function index()
    {
        $modelTask = new \model\Task();

        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        } else {
            $sort = 'id';
        }

        if (isset($_GET['order'])) {
            $order = $_GET['order'];
        } else {
            $order = 1;
        }

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $data = array(
            'sort' => $sort,
            'order' => $order,
            'start' => ($page - 1) * 3,
            'limit' => 3
        );

        $result = $modelTask->getTasks($data);
        $total = $modelTask->getTotalTask();

        $pagination = new Pagination();
        $pagination->total = $total->row['total'];
        $pagination->page = $page;
        $pagination->limit = 3;
        $pagination->url = '/task?page={page}';

        $this->output->view('task', ['tasks' => $result->rows, 'pagination' => $pagination->render()]);
    }

    public function insert()
    {
        $this->output->view('task.form');
    }

    public function save()
    {
        $validation = [];

        $validation = $this->validation($_POST);

        if (count($validation) !== 0) {
            $this->output->view('task.form', ['validation' => $validation]);
        }

        $data = [];
        $data['name'] = $_POST['name'];
        $data['email'] = $_POST['email'];
        $data['text'] = $_POST['text'];

        try {
            $modelTask = new \model\Task();
            $modelTask->addTask($data);

            header('Location: /');
            exit;
        } catch (Exception $e) {
            echo "Error:" . $e->getMessage();
        }
    }

    public function edit()
    {
        if (!isset($_GET['id'])) {
            header('Location: /');
        }

        $modelTask = new \model\Task();
        $result = $modelTask->getTask((int)$_GET['id']);

        $this->output->view('task.form', ['task' => $result->row]);
    }

    public function update()
    {
        $validation = [];
        $validation = $this->validation($_POST);

        if (!isset($_SESSION['user'])) {
            header('Location: /');
        }

        if (count($validation) !== 0) {
            $this->output->view('task.form', ['task' => $_POST, 'validation' => $validation]);
        }

        $data = [];
        $data['name'] = $_POST['name'];
        $data['email'] = $_POST['email'];
        $data['text'] = $_POST['text'];

        try {
            $modelTask = new \model\Task();
            $modelTask->updateTask((int)$_POST['id'], $data);

            header('Location: /');
            exit;
        } catch (Exception $e) {
            echo "Error:" . $e->getMessage();
        }
    }

    public function remove()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
        }

        try {
            $modelTask = new \model\Task();
            $modelTask->addRemove((int)$_GET['id']);

            header('Location: /');
            exit;
        } catch (Exception $e) {
            echo "Error:" . $e->getMessage();
        }
    }

    public function validation($data): array
    {
        $validation = [];

        if (empty($data["name"])) {
            $validation['name'] = "Name is required";
        }

        if (empty($data["email"])) {
            $validation['email'] = "Email is required";
        } else {
            $email = $data["email"];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validation['email'] = "Invalid email format";
            }
        }

        if (empty($data["text"])) {
            $validation['name'] = "Text is required";
        }

        return $validation;
    }
}
