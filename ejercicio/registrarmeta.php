<?php
//print_r($_POST);
if (empty($_POST["txtMeta"]) || empty($_POST["txtDuracion"]) || empty($_POST["codigo"])) {
    header('Location: index.php');
    exit();
}

include_once 'model/conexion.php';
$meta = $_POST["txtMeta"];
$duracion = $_POST["txtDuracion"];
$codigo = $_POST["codigo"];


$sentencia = $bd->prepare("INSERT INTO metas(meta,duracion,id_empleado) VALUES (?,?,?);");
$resultado = $sentencia->execute([$meta,$duracion,$codigo]);

if ($resultado === TRUE) {
    header('Location: agregarmeta.php?codigo='.$codigo);
} 