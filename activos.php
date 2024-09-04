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
    <title>Proveedores Activos</title>
    <link rel="stylesheet" href="./styles/style.css" />
</head>
<body>
    <header>
        <h1>Proveedores Activos</h1>
        <h3 class="user-name">Hola <span><?= @$_SESSION['full_name']; ?></span>, ¡bienvenido!</h3>
        <?php
        include 'templates/section_menu.php';
        ?>
    </header>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>NIT</th>
                    <th>Nombre Completo</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Activo</th>
                </tr>
            </thead>
            <?php
                include 'conexion.php';

                $sql = "SELECT NIT, Nombre, Telefono, Direccion, Activo FROM Proveedores WHERE Activo = 1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<tbody>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["NIT"] . "</td>";
                        echo "<td>" . $row["Nombre"] . "</td>";
                        echo "<td>" . $row["Telefono"] . "</td>";
                        echo "<td>" . $row["Direccion"] . "</td>";
                        echo "<td class='status'>" . ($row["Activo"] ? "<span class='status-active'>Activo</span>" : "<span class='status-inactive'>Inactivo</span>") . "</td>";
                        echo "</tr>";
                    }

                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "No hay proveedores disponibles.";
                }

                $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
