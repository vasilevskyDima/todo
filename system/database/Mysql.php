<?php

namespace system\database;
final class MySQL
{
    private $connection;

    public function __construct($hostname, $username, $password, $database, $port = '3306')
    {
        try {
            $mysqli = @new \MySQLi($hostname, $username, $password, $database, $port);

            $this->connection = $mysqli;
            $this->connection->set_charset('utf8mb4');
            $this->connection->query("SET SESSION sql_mode = 'NO_ZERO_IN_DATE,NO_ENGINE_SUBSTITUTION'");
            $this->connection->query("SET FOREIGN_KEY_CHECKS = 0");
        } catch (\mysqli_sql_exception $e) {
            echo "Error";
        }
    }

    /**
     * @param $sql
     * @return bool|object
     */
    public function query($sql): bool|object
    {
        $data = [];
        $query = $this->connection->query($sql);

        if ($query instanceof \mysqli_result) {
            while ($row = $query->fetch_assoc()) {
                $data[] = $row;
            }

            $result = new \stdClass();
            $result->num_rows = $query->num_rows;
            $result->row = isset($data[0]) ? $data[0] : [];
            $result->rows = $data;
            $query->close();

            return $result;
        } else {
            return true;
        }
    }

    /**
     * @param string $value
     * @return string
     */
    public function escape(string $value): string {
        return $this->connection->real_escape_string($value);
    }
}