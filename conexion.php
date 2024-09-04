<?php
$servername = "localhost";
$username = "desarrollo_web";
$password = "desarrollo";
$dbname = "laboratorio_clase7";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
