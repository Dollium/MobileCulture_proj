<?php
date_default_timezone_set('Europe/Helsinki');

$servername = 'localhost';
$username = 'root';
$password = '';
$db = 'mobileculturez';

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection

function finnish_dateformat($date)
{
    return date('d.m.Y', strtotime($date));
}
