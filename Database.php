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

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function select(...$columns)
    {
        $a = $columns;
        $text = implode(",", $a);
        $this->sql = "SELECT $text FROM $this->table";
        return $this;
    }

    public function where($key,$operator,$value = null)
    {
        if(is_int($operator)){
            $this->sql .= " WHERE $key" . " = " . " $operator";
        }else{
            $this->sql .= " WHERE $key $operator $value";
        }


        return $this;
    }

    public function delete()
    {
        $this->sql = "DELETE FROM $this->table";
        return $this;
    }

    public function insert($pair = []) {
        $keyString ="";
        $valueString ="";
            foreach ($pair as $key=>$value) {
              $keyString .= $key.",";
              $valueString .="'$value'".",";
             }
        $keyString =substr($keyString,0,-1);
        $valueString =substr($valueString,0,-1);

        $this->sql = "INSERT INTO $this->table ($keyString) VALUES ($valueString)";
        return $this;
    }

    public function update($pair = []){
        $final ="";
        foreach ($pair as $key=>$value) {
            $final .= $key." = ". "'$value'".",";
        }
        $final = substr($final,0,-1);
        $this->sql = "UPDATE $this->table SET $final";
        return $this;
    }

    public function get()
    {
        $result = $this->conn->query($this->sql) or die($this->conn->error);
//            while ($record = $result->fetch_assoc()) {
//                echo "id: " . $record["name"] . "<br>";
    }

}









