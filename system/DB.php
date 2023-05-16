<?php

namespace system;
class DB
{
    private $db;

    public function __construct($driver, $hostname, $username, $password, $database, $port = NULL)
    {
        $class = 'system\database\\' . $driver;

        if (class_exists($class)) {
            $this->db = new $class($hostname, $username, $password, $database, $port);
        } else {
            exit('error');
        }
    }

    public function query($sql)
    {
        return $this->db->query($sql);
    }

    public function escape(string $value): string {
        return $this->db->escape($value);
    }
}