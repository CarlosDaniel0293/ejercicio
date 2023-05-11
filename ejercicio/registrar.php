<?php
//print_r($_POST);
if (empty($_POST["oculto"]) || empty($_POST["txtNombres"]) || empty($_POST["txtApellidos"]) || empty($_POST["txtCorreo"]) || empty($_POST["txtCelular"])) {
    header('Location: index.php?mensaje=falta');
    exit();
}

include_once 'model/conexion.php';
$nombres = $_POST["txtNombres"];
$apellidos = $_POST["txtApellidos"];
$correo = $_POST["txtCorreo"];
$celular = $_POST["txtCelular"];

$sentencia = $bd->prepare("INSERT INTO empleados(nombres,apellidos,correo,celular) VALUES (?,?,?,?);");
$resultado = $sentencia->execute([$nombres, $apellidos, $correo, $celular]);

if ($resultado === TRUE) {
    header('Location: index.php?mensaje=registrado');
} else {
    header('Location: index.php?mensaje=error');
    exit();
}
?>