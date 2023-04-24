<?php
// Conectar a la base de datos
    $hostname = 'localhost';
    $username = 'mario';
    $password = 'prueba123';
    $database = 'estadosdispositivos';
    $conexion = mysqli_connect($hostname, $username, $password, $database);


if (isset($_POST['estado'])) { // Checar si se recibio algo del alert y no viene vacio
  $puerta_estado = intval($_POST['estado']);

  date_default_timezone_set('America/Mexico_City');// establcece la fecha y hora actual
  $timestamp = date('Y-m-d H:i:s');

  // insert del estado de la puerta en el historial
  $insertar_historial_puerta = "INSERT INTO historialpuerta (estado, fecha_hora) VALUES ('$puerta_estado', '$timestamp')";
  mysqli_query($conexion, $insertar_historial_puerta);

  // insert del estado actual de la puerta
  $insertar_puerta = "INSERT INTO puerta (estado, fecha_hora) VALUES ('$puerta_estado', '$timestamp')";
  mysqli_query($conexion, $insertar_puerta);

  mysqli_close($conexion);
}
?>
