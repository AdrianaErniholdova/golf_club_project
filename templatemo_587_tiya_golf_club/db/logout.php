<?php

use users\Users;

define('__ROOT__', dirname(dirname(__FILE__)));
include_once ('../classes/Users.php');
$users = new Users();
$users->logout();
?>