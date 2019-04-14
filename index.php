<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php
        include "Database.php";
        $database = new Database("localhost","root","","testdatabase");
//      $database->table('users')->select('id','name','surname')->where("id", ">",28 )->get();
        $database->table('users')->delete()->where('id', '>',66)->where('id','<', 72)->get();
//      $database->table('users')->insert(['name'=>'aper','surname'=>'sargsyan'])->get();
//      $database->table('users')->update(['surname'=>'vaxo','adress'=>'vaxo@gmail.com'])->where('id','=', 56)->get();

?>

</body>
</html>