<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Control de dispositivos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Control de dispositivos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" href="grafica_puerta.php">Historial de puerta</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="grafica_termometro.php">Historial de termometro</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <section class="container">
    <div class="row">
      <div class="col-md-6 col-12">
        <div class="col-md-6 col-12 w-100 mb-3">
          <img id="puerta" src="imagenes/puerta_cerrada.jpg" class="img">
        </div>
        <button id="cambiar_puerta" class="btn btn-dark">Cambiar estado de la puerta</button>
      </div>
      <div class="col-md-6 col-12">
        <div class="col-md-6 col-12 w-100 mb-3">
          <img id="termometro" src="imagenes/termometro_azul.jpg" class="img">
        </div>
        <button id="cambiar_termometro" class="btn btn-dark">Cambiar estado del termómetro</button>
      </div>
    </div>
  </section>
  

  

  <script>
    function actualizarDatos() {
      $.ajax({
        url: 'conexion.php',
        type: 'GET',
        dataType: 'json',
        success: function(datos) {
          // Actualizar la imagen de la puerta
          var puertaImagen = $('#puerta');
          if (datos.puerta == 1) {
            puertaImagen.attr('src', 'imagenes/puerta_abierta.jpg');
          } else {
            puertaImagen.attr('src', 'imagenes/puerta_cerrada.jpg');
          }

          // Actualizar la imagen del termometro
          var termometroImagen = $('#termometro');
          if (datos.termometro == 1) {
            termometroImagen.attr('src', 'imagenes/termometro_rojo.jpg');
          } else {
            termometroImagen.attr('src', 'imagenes/termometro_azul.jpg');
          }
        },
        error: function() {
          console.log('Error al obtener los datos');
        }
      });
    }

    
    setInterval(actualizarDatos, 100);

	// Codigo para modificar el estado de la puerta
	$('#cambiar_puerta').click(function() {
      var nuevoEstado = prompt('Ingrese el estado de la puerta (0 para cerrada, 1 para abierta):');
      if (nuevoEstado === '0' || nuevoEstado === '1') {
        $.ajax({
          url: 'cambiar_puerta.php',
          type: 'POST',
          data: {estado: nuevoEstado},
          success: function() {
            console.log('Estado de la puerta cambiado');
          },
          error: function() {
            console.log('Error al cambiar el estado');
          }
        });
      } else {
        alert('El estado no es valido');
      }
    });

	// Codigo para modificar el estado del termometro
	$('#cambiar_termometro').click(function() {
      var nuevoEstado = prompt('Ingrese el estado del termómetro (0 para azul, 1 para rojo):');
      if (nuevoEstado === '0' || nuevoEstado === '1') {
        $.ajax({
          url: 'cambiar_termometro.php',
          type: 'POST',
          data: {estado: nuevoEstado},
          success: function() {
            console.log('Estado del termómetro cambiado');
          },
          error: function() {
            console.log('Error al cambiar el estado');
          }
        });
      } else {
        alert('El estado ingresado no es válido');
      }
    });

  </script>
</body>
</html>
