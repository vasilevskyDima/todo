<?php

namespace controller;

use system\Pagination;

class Task extends BaseController
{
    /**
     * @return void
     */
    public function index(): void
    {
        $modelTask = new \model\Task();

        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
        $order = isset($_GET['order']) ? $_GET['order'] : 1;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $data = [
            'sort' => $sort,
            'order' => $order,
            'start' => ($page - 1) * 3,
            'limit' => 3
        ];

        $result = $modelTask->getTasks($data);
        $total = $modelTask->getTotalTask();

        $pagination = new Pagination();
        $pagination->total = $total->row['total'];
        $pagination->page = $page;
        $pagination->limit = 3;
        $pagination->url = '/task?page={page}';

        $this->output->view('task', ['tasks' => $result->rows, 'pagination' => $pagination->render()]);
    }

    /**
     * @return void
     */
    public function insert(): void
    {
        $this->output->view('task.form');
    }

    /**
     * @return void
     */
    public function save(): void
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

    /**s
     * @return void
     */
    public function edit(): void
    {
        if (!isset($_GET['id'])) {
            header('Location: /');
        }

        $modelTask = new \model\Task();
        $result = $modelTask->getTask((int)$_GET['id']);

        $this->output->view('task.form', ['task' => $result->row]);
    }

    /**
     * @return void
     */
    public function update(): void
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

    /**
     * @return void
     */
    public function remove(): void
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

    /**s
     * @param $data
     * @return array
     */
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
