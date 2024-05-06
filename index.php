<?php
session_start();

// Verificar si el usuario está autenticado y tiene un rol asignado
if(isset($_SESSION['rol'])) {
    if($_SESSION['rol'] == 'admin') {
        header('Location: admin.php');
        exit;
    } elseif($_SESSION['rol'] == 'Cliente') {
        header('Location: cliente.php');
        exit;
    }
}

// Si el usuario no está autenticado, redirigirlo al formulario de inicio de sesión
header('Location: login.php');
exit;
?>
