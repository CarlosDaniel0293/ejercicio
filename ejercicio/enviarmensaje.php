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

    $url = 'https://api.green-api.com/waInstance1101817912/SendMessage/1f356ed43e944441802ddff9b2a3eb44414d49d0ec3142e8b5';
    $data = [
        "chatId" => "51".$empleados->celular."@c.us",
        "message" =>  'Estimado(a) *'.strtoupper($empleados->nombres).' '.strtoupper($empleados->apellidos).' registrado con el correo: * '.strtoupper($empleados->correo).'* Esperamos que pueda cumplir con la meta establecida de *'.strtoupper($empleados->meta).'* en el tiempo estimado de *'.$empleados->duracion.'dia(s) *'
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

