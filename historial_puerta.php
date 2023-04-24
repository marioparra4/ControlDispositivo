<?php
    $hostname = "localhost";
    $username = "mario";
    $password = "prueba123";
    $dbname = "estadosdispositivos";

    $conexion = mysqli_connect($hostname, $username, $password, $dbname);

    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    $consulta = "SELECT estado, fecha_hora FROM historialpuerta WHERE fecha_hora >= '$fecha_inicio' AND fecha_hora <= '$fecha_fin' ORDER BY fecha_hora ASC";
    $result = mysqli_query($conexion, $consulta);

    //asocia los resultados de la consulta a un array
    $historial_puerta = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $historial_puerta[] = $row;
    }

    echo json_encode($historial_puerta); // convierte en json los datos

    mysqli_close($conexion);
?>
