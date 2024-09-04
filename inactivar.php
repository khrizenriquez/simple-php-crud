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
    <title>Desactivar Proveedor</title>
    <link rel="stylesheet" href="./styles/style.css" />
</head>
<body>
    <header>
        <h1>Desactivar Proveedor</h1>
        <h3 class="user-name">Hola <span><?= htmlspecialchars($_SESSION['full_name']); ?></span>, ¡bienvenido!</h3>
        <?php
        include 'templates/section_menu.php';
        ?>
    </header>

    <div class="container">
        <p>Ingresa el NIT del proveedor que deseas desactivar:</p>

        <?php
        include 'conexion.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nit = $_POST['nit'];

            $stmt = $conn->prepare("CALL DesactivarProveedor(?)");
            $stmt->bind_param("s", $nit);

            if ($stmt->execute()) {
                echo "<div class='success-message'>Proveedor desactivado exitosamente.</div>";
                echo "<script>
                        setTimeout(function() {
                            document.querySelector('.success-message').style.display = 'none';
                        }, 5000);
                      </script>";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }

        $sql = "SELECT NIT, Nombre FROM Proveedores WHERE Activo = 1";
        $result = $conn->query($sql);

        $conn->close();
        ?>

        <form class="form-control" action="inactivar.php" method="POST">
            <div class="form-group">
                <label for="nit">NIT</label>
                <input list="nits" type="text" id="nit" name="nit" required maxlength="20" />
                <datalist id="nits">
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row["NIT"]) . "'>" . htmlspecialchars($row["NIT"]) . " - " . htmlspecialchars($row["Nombre"]) . "</option>";
                        }
                    }
                    ?>
                </datalist>
            </div>
            <div class="form-group">
                <button class="button button-danger" type="submit">Desactivar</button>
            </div>
        </form>
    </div>
</body>
</html>
