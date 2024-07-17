<?php
error_reporting(0);
require('../service/UserService.php');
$service = new UserService();

$service->unlogUser();
echo 'done';

