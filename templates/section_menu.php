<?php
$activePage = basename($_SERVER['PHP_SELF']);
?>

<nav class="menu">
    <a class="<?= $activePage == 'index.php' ? 'active' : ''; ?>" href="index.php">Principal</a>
    <a class="<?= $activePage == 'ingresar.php' ? 'active' : ''; ?>" href="ingresar.php">Ingresar Proveedor</a>
    <a class="<?= $activePage == 'inactivar.php' ? 'active' : ''; ?>" href="inactivar.php">Desactivar Proveedor</a>
    <a class="<?= $activePage == 'activos.php' ? 'active' : ''; ?>" href="activos.php">Proveedores Activos</a>
    <a class="menu-logout" href="logout.php">Cerrar Sesión</a>
</nav>
