<?php
error_reporting(0);
require('../service/UserService.php');
$service = new UserService();


$email = $_POST['email'];
$password = $_POST['password'];

if(!$email || !$password ){
    echo "empty data";

}else{
    $service = new UserService();
    echo ($service->loginUser($email,$password))?"ok":"error";
}
header( "refresh:5;url=../index.html" );