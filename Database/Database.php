<?php

namespace Database\database;

use PDO;
use PDOException;

class Database
{
    private $connection_db;
    private $option = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    );
    private $db_name = DB_NAME;
    private $user_name = USERNAME;
    private $password_db = PASSWORD_DB;
    private $host_name = HOSTNAEM;

    public function __construct()
    {
        try {
            $this->connection_db = new PDO("mysql:host=" . $this->host_name . ";dbname=" . $this->db_name, $this->user_name, $this->password_db, $this->option);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
    public function Select($sql, $where = null)
    {
        try {
            $statment = $this->connection_db->prepare($sql);
            if ($where == null) {
                $statment->execute();
                $results = $statment->fetchAll();
            } else {
                $statment->execute([$where]);
                $results = $statment->fetch();
            }
            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function SelectAll($sql, $where = null)
    {
        try {
            $statment = $this->connection_db->prepare($sql);
            if ($where == null) {
            } else {
                $statment->execute([$where]);
            }
            $results = $statment->fetchAll();
            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function Insert($table, $filds, $values)
    {
        $sql = "INSERT INTO " . $table . "(" . implode(", ", $filds) . ", created_at) VALUES (:" . implode(", :", $filds) . ", now());";
        try {
            $statment = $this->connection_db->prepare($sql);
            $statment->execute(array_combine($filds, $values));
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function Update($table, $filds, $values, $id)
    {
        $sql = "UPDATE " . $table . " SET ";
        foreach (array_combine($filds, $values) as $key => $value) {
            if ($value == null) {
                $sql .= $key . "= null ,";
            } else {
                $sql .= $key . "= ?, ";
            }
        }
        $sql .= "updated_at = now() ";
        $sql .= "WHERE id = ? ";
        try {
            $statment = $this->connection_db->prepare($sql);
            $statment->execute(array_merge(array_filter($values), [$id]));
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function Delete($table, $where)
    {
        try {
            $statment = $this->connection_db->prepare("DELETE FROM " . $table . " WHERE id = ?");
            $statment->execute([$where]);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    protected function createTable($sql)
    {
        try {
            $this->connection_db->exec($sql);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
