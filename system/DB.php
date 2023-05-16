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

    /**
     * @param $sql
     * @return bool|object
     */
    public function query($sql): bool|object
    {
        return $this->db->query($sql);
    }

    /**
     * @param string $value
     * @return string
     */
    public function escape(string $value): string {
        return $this->db->escape($value);
    }
}