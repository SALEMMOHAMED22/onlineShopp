<?php

require_once '../App.php';


$session->remove("user_id");

$session->set("success" , "Logged out");

$request->redirect("../index.php");
