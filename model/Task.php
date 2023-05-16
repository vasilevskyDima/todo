<?php

namespace model;

use system\DB;

class Task
{
    public $conect;

    public function __construct()
    {
        $this->conect = new DB('Mysql', 'localhost', 'root', 'Dima@5899887', 'project');
    }

    public function addTask($data = [])
    {
        $this->conect->query("INSERT INTO task SET name = '" . $this->conect->escape($data['name']) . "', email = '" . $this->conect->escape($data['email']) . "', text = '" . $this->conect->escape($data['text']) . "'");
    }

    public function updateTask($id, $data = [])
    {
        $this->conect->query("UPDATE task SET name = '" . $this->conect->escape($data['name']) . "', email = '" . $this->conect->escape($data['email']) . "', text = '" . $this->conect->escape($data['text']) . "' , status = 1 WHERE id=" . (int)$id);
    }

    public function getTasks($data = [])
    {
        $sql = "SELECT * FROM task ";

        if (isset($data['sort'])) {
            $sql .= " ORDER BY " . $data['sort'];
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC, LCASE(name) DESC";
        } else {
            $sql .= " ASC, LCASE(name) ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 10;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        return $this->conect->query($sql);
    }

    public function getTotalTask()
    {
        return $this->conect->query("SELECT count(*) as total FROM task");
    }

    public function getTask($id)
    {
        return $this->conect->query("SELECT * FROM task WHERE id=" . (int)$id);
    }

    public function addRemove($id)
    {
        return $this->conect->query("DELETE FROM task WHERE id=" . (int)$id);
    }


}