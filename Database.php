<?php

class Database
{
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $conn;
    public $sql;
    public $table;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->DbConnect();
    }

    public function DbConnect()
    {
        // Create connection
        $this->conn = new \mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->connect_error);
        }
    }

    public function select($table)
    {
        $this->table = $table;
        $this->sql = "SELECT * FROM $table";
        $result = $this->conn->query($this->sql) or die($this->conn->error);
        while ($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"] . " - Name: " . $row["name"] . " " . $row["surname"] . "<br>";
        }
        return $this;
    }

    public function where($id){
        $this->sql = "SELECT * FROM $this->table WHERE id = $id";
        $result = $this->conn->query($this->sql) or die($this->conn->error);
        while ($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"] . " - Name: " . $row["name"] . " " . $row["surname"] . "<br>";
        }
    }
}
