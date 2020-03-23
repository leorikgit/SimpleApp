<?php
include_once __DIR__."../../core/ini.php";

use Factory\Database\DatabaseFactory;



$DatabaseFactoryInstance = DatabaseFactory::build('mysql');
$query = $DatabaseFactoryInstance->Getconnection()->query('SELECT * FROM users');
$query->execute();
$users = $query->fetchAll(PDO::FETCH_ASSOC);
var_dump($users);


?>
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
hello
</body>
</html>