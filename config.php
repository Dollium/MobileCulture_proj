<?php
date_default_timezone_set('Europe/Helsinki');

$servername = 'localhost';
$username = 'root';
$password = 'Dsa987zxc!';
$db = 'mobileculture';

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if(!$conn)
{
  echo "can't connect";
}

function finnish_dateformat($date)
{
    return date('d.m.Y', strtotime($date));
}
