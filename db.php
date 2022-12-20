<?php

class Database
{
    private $db_host = "localhost";
    private $db_user = "testdes191662com";
    private $db_pass = "3zYHUlD";
    private $db_name = "dbtestdevphplalainas191662com";
    private $result = [];
    private $conn = false;
    private $mysqli = "";

    public function __construct()
    {
        if (!$this->conn) {
            $this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
            if ($this->mysqli->connect_error) {
                array_push($this->result, $this->mysqli->connect_error);
                return false;
            }
        } else {
            return true;
        }
    }

    public function insert(string $table, array $data)
    {
        if ($this->tableExists($table)) {
            $table_column = implode(', ', array_keys($data));
            $valeur = [];
            foreach ($data as $da) {
                $valeur[] = '\'' . $da . '\'';
            }
            $val = implode(',', $valeur);

            $sql = "INSERT INTO $table ($table_column) VALUES ($val)";
            if ($this->mysqli->query($sql)) {
                $this->result[] = $this->mysqli->insert_id;
                return true;
            } else {
                $this->result[] = $this->mysqli->error;
                return false;
            }
        } else {
            return false;
        }
    }

    public function update(string $table, array $data, string $where = null)
    {
        if ($this->tableExists($table)) {
            $args = [];
            foreach ($data as $k => $dt) {
                $args[] = "$k = '$dt'";
            }
            $val = implode(',', $args);
            $sql = "UPDATE $table SET $val";
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($this->mysqli->query($sql)) {
                $this->result[] = "modifier avec success";
                return true;
            } else {
                $this->result[] = $this->mysqli->error;
                return false;
            }
        } else {
            return false;
        }
    }

    public function delete(string $table, string $where = null)
    {
        if ($this->tableExists($table)) {
            $sql = "DELETE FROM $table";
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($this->mysqli->query($sql)) {
                $this->result[] = "supprimer avec success";
                return true;
            } else {
                $this->result[] = $this->mysqli->error;
                return false;
            }
        } else {
            return false;
        }
    }

    public function select(string $table, string $rows = "*", string $join = null, string $where = null, string $order = null, string $limit = null, $joi = null)
    {
        if ($this->tableExists($table)) {
            $sql = "SELECT $rows FROM $table";
            if ($join != null) {
                $sql .= " JOIN $join";
            }
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($order != null) {
                $sql .= " ORDER BY $order";
            }
            if ($limit != null) {
                $sql .= " LIMIT  0,$limit";
            }
            if ($joi != null) {
                $sql .= "LEFT JOIN  $joi";
            }

            $query = $this->mysqli->query($sql);
            if ($query) {
                return $query->fetch_all(MYSQLI_ASSOC);
            } else {
                $this->result[] = $this->mysqli->error;
                return false;
            }
        } else {
            return false;
        }
    }

    public function sql(string $sql)
    {
        $query = $this->mysqli->query($sql);
        if ($query) {
            $this->result = $query->fetch_all(MYSQLI_ASSOC);
        } else {
            $this->result[] = $this->mysqli->error;
            return false;
        }
    }

    private function tableExists(string $table): bool
    {
        $sql = "SHOW TABLES FROM $this->db_name LIKE '$table'";
        $tableInDb = $this->mysqli->query($sql);
        if ($tableInDb->num_rows == 1) {
            return true;
        }
        $this->result[] = " la table : $table n'existe pas";
        return false;
    }

    public function getResult()
    {
        $val = $this->result;
        $this->result = [];
        return $val;
    }
}
