<?php

$dbname = 'mysql:host=localhost;dbname=buyerside';
$user = 'root';
$pass = '';
$con = new PDO($dbname, $user, $pass);


function uniq_id()
{
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strlen($chars);
    $randomString = "";
    for ($i = 0; $i < 20; $i++) {
        $randomString .= $chars[mt_rand(0, $charLength - 1)];
    }
    return $randomString;
}


?>