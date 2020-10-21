<?php

$server = $_SERVER["SERVER_NAME"];

if( $server == "127.0.0.1" || $server == "localhost"){
    $dbName = "formation";
    $dbUser = "root";
    $dbPass = "";
} else {
    $dbName = "193923";
    $dbUser = "193923";
    $dbPass = "uGG6eES28Hi6SuM";
}

return new PDO(
    "mysql:host=127.0.0.1;dbname=${dbName};charset=utf8",
    $dbUser,
    $dbPass,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);