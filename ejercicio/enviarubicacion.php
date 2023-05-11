<?php
if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("SELECT met.meta, met.duracion, met.id_empleado, emp.nombres ,emp.apellidos ,emp.correo ,emp.celular
  FROM metas met 
  INNER JOIN empleados emp ON emp.id = met.id_empleado 
  WHERE met.id = ?;");
$sentencia->execute([$codigo]);
$empleados = $sentencia->fetch(PDO::FETCH_OBJ);

    $url = 'https://api.green-api.com/waInstance1101817912/SendLocation/1f356ed43e944441802ddff9b2a3eb44414d49d0ec3142e8b5';
    $data = [
        "chatId" => "51".$empleados->celular."@c.us",
        "nameLocation" => "MotorSur",
        "addres" => "Av. La Marina",
        "latitude" => -16.402837125380003, 
        "longitude" => -71.54272363195201
    ];
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => json_encode($data),
            'header' =>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);
?> 

