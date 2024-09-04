<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento de Proveedores</title>
    <link rel="stylesheet" href="./styles/style.css" />
    <link rel="stylesheet" href="./styles/login.css">
</head>
<body>
    <?php
    if (!isset($_SESSION['loggedin']) == 1) {
        include './templates/login.php';
    }
    ?>

    <article class="<?= (!isset($_SESSION['loggedin']) == 1) ? 'blurred' : '' ?>">
        <header>
            <h1>Mantenimiento de Proveedores</h1>
            <h3 class="user-name">Hola <span><?= @$_SESSION['full_name']; ?></span>, ¡bienvenido!</h3>
            <?php
            //  Include del menu, para no repetir todo ese codigo
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

                    $sql = "SELECT NIT, Nombre, Telefono, Direccion, Activo FROM Proveedores";
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
    </article>
</body>
</html>
