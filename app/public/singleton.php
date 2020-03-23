<?php
include_once __DIR__."../../core/ini.php";


use Singleton\User\User;
$users = new User();
foreach ($users->getAllUsers()->getResult() as $user) {
    var_dump($user);
}


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
