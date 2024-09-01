<?php
//require_once 'inc/connection.php';
require_once 'classes/request.php';
require_once 'classes/session.php';
require_once 'classes/Validation.php';
require_once 'classes/file.php';
require_once 'classes/password.php';



use onlineShop\classess\Request;
use onlineShop\classess\Sesseion;
use onlineShop\classess\Validation;
use onlineShop\classess\File;
use onlineShop\classess\Password;



$request = new Request;
$session = new Sesseion;
$validation = new Validation;
$file = new File;
$passCheck = new Password;



