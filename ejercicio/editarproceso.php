<?php
    print_r($_POST);
    if(!isset($_POST['codigo'])){
        header('Location: index.php?mensaje=error');
    }

    include 'model/conexion.php';
    $codigo = $_POST['codigo'];
    $nombres = $_POST['txtNombres'];
    $apellidos = $_POST['txtApellidos'];
    $correo = $_POST['txtCorreo'];
    $celular = $_POST['txtCelular'];

    $sentencia = $bd->prepare("UPDATE empleados SET nombres = ?, apellidos = ?, correo = ?, celular = ? where id = ?;");
    $resultado = $sentencia->execute([$nombres, $apellidos, $correo, $celular, $codigo]);

    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=editado');
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }
