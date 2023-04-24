<?php 
    $hostname = 'localhost';
    $username = 'mario';
    $password = 'prueba123';
    $database = 'estadosdispositivos';

    
    $conexion = mysqli_connect($hostname, $username, $password, $database);

    // Comprobar si la conexión fue exitosa
    if (!$conexion) {
        die('Error de conexión: ' . mysqli_connect_error());
    }

    // Obtiene el estado actual de la puerta y el termometro
    $puerta_query = "SELECT estado FROM puerta ORDER BY fecha_hora DESC LIMIT 1";
    $termometro_query = "SELECT estado FROM termometro ORDER BY fecha_hora DESC LIMIT 1";
    $puerta_result = mysqli_query($conexion, $puerta_query);
    $termometro_result = mysqli_query($conexion, $termometro_query);

    
    $puerta_estado = mysqli_fetch_assoc($puerta_result);
    $puerta_estado = $puerta_estado['estado'];
    $termometro_estado = mysqli_fetch_assoc($termometro_result);
    $termometro_estado = $termometro_estado['estado'];

    // Devolver los valores como un objeto JSON
    $estados = array('puerta' => $puerta_estado, 'termometro' => $termometro_estado);
    header('Content-Type: application/json');
    echo json_encode($estados);

    mysqli_close($conexion);
?>