<?php
error_reporting(0);
require('../service/UserService.php');
$service = new UserService();

echo ($service->getUser())?$service->getUser():"none";