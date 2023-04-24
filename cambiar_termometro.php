<?php
// Conectar a la base de datos
    $hostname = 'localhost';
    $username = 'mario';
    $password = 'prueba123';
    $database = 'estadosdispositivos';
    $conexion = mysqli_connect($hostname, $username, $password, $database);


if (isset($_POST['estado'])) { // checar si se recibio el estado del termometro
  $termometro_estado = intval($_POST['estado']);

  date_default_timezone_set('America/Mexico_City');
  $timestamp = date('Y-m-d H:i:s');

  // insertar el estado de la termometro en el historial
  $insertar_historial_termometro = "INSERT INTO historialtermometro (estado, fecha_hora) VALUES ('$termometro_estado', '$timestamp')";
  mysqli_query($conexion, $insertar_historial_termometro);

  // insertar el estado de la termometro en termometro
  $insertar_termometro = "INSERT INTO termometro (estado, fecha_hora) VALUES ('$termometro_estado', '$timestamp')";
  mysqli_query($conexion, $insertar_termometro);

  // Cerrar la conexión a la base de datos
  mysqli_close($conexion);
}
?>