<?php
session_start();

include '../conexion.php';

$email = trim($_POST['email']);
$password = trim($_POST['password']);

if (empty($email) || empty($password)) {
    die("Por favor, ingrese su correo electrónico y contraseña.");
}

$stmt = $conn->prepare("SELECT email, password_hash, full_name FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($db_email, $db_password_hash, $db_full_name);
    $stmt->fetch();

    if (password_verify($password, $db_password_hash)) {
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $db_email;
        $_SESSION['full_name'] = $db_full_name;

        //print_r($_SESSION);
        header("Location: ../index.php");
        exit();
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "El usuario no existe.";
}

$stmt->close();
$conn->close();
?>

