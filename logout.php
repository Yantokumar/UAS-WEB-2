<?php
session_start();
require_once 'config/Auth.php';

$auth = new Auth();
$auth->logout();
?>