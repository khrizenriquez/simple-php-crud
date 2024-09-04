<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Proveedor</title>
    <link rel="stylesheet" href="./styles/style.css" />
</head>
<body>
    <header>
        <h1>Nuevo Proveedor</h1>
        <h3 class="user-name">Hola <span><?= @$_SESSION['full_name']; ?></span>, ¡bienvenido!</h3>
        <?php
        include 'templates/section_menu.php'; // Incluye el menú
        ?>
    </header>

    <div class="container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include 'conexion.php';

            $nit = $_POST['nit'];
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];

            $stmt = $conn->prepare("CALL InsertarProveedor(?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nit, $nombre, $telefono, $direccion);

            if ($stmt->execute()) {
                echo "<div class='success-message'>Proveedor guardado exitosamente.</div>";
                
                echo "<script>
                        setTimeout(function() {
                            document.querySelector('.success-message').style.display = 'none';
                        }, 5000);
                      </script>";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        }
        ?>

        <form class="form-control" action="ingresar.php" method="POST">
            <div class="form-group">
                <label for="nit">NIT</label>
                <input type="text" id="nit" name="nit" maxlength="40" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" maxlength="100" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" maxlength="15" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" maxlength="255" name="direccion" required>
            </div>
            <div class="form-group">
                <button class="button button-primary" type="submit">Guardar</button>
            </div>
        </form>
    </div>

</body>
</html>
