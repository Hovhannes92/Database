<?php
class Database
{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;
    private $table;
    private $sql = array();

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
        $this->sql[] = "SELECT $text FROM $this->table";
        return $this;
    }

    public function delete()
        {
    $this->sql[] = "DELETE FROM $this->table";
         return $this;
        }

    public function stringMaker($key,$operator,$value = null){
        if (is_null($value)) {
            $value = $operator;
            $operator = " = ";
        }
        $this->sql[] = " $key $operator $value";
    }

    public function where($key,$operator,$value = null)
    {
        if(!in_array(" WHERE ", $this->sql)){
            $this->sql[] = " WHERE ";
            $this->stringMaker($key,$operator,$value);
        }else{
            $this->sql[] = " AND ";
            $this->stringMaker($key,$operator,$value);
        }
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
        $this->sql[] = "INSERT INTO $this->table ($keyString) VALUES ($valueString)";
        return $this;
    }
    public function update($pair = []){
        $final ="";
        foreach ($pair as $key=>$value) {
            $final .= $key." = ". "'$value'".",";
        }
        $final = substr($final,0,-1);
        $this->sql[] = "UPDATE $this->table SET $final";
        return $this;
    }
    public function get()
    {
        $queryString = implode("",$this->sql);
        $result = $this->conn->query($queryString) or die($this->conn->error);
//            while ($record = $result->fetch_assoc()) {
//                echo "id: " . $record["name"] . "<br>";
    }
}
