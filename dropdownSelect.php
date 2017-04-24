<?php
include 'config.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
$selected = $_POST['inst'];
echo $selected;
