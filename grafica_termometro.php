<!DOCTYPE html>
<html>
<head>
	<title>Gráfica del termometro</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  	<link rel="stylesheet" href="estilos.css">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#grafica-termometro').on('click', function() {
				var fecha_inicio = $('#fecha-inicio').val();
				var fecha_fin = $('#fecha-fin').val();
				$.ajax({
					url: 'historial_termometro.php',
					type: 'POST',
					data: {fecha_inicio: fecha_inicio, fecha_fin: fecha_fin},
					success: function(data) {
						var labels = [];
						var data_values = [];
						var historial_termometro = JSON.parse(data);
						for (var i = 0; i < historial_termometro.length; i++) {
							labels.push(historial_termometro[i].fecha_hora);
							data_values.push(historial_termometro[i].estado);
						}
						var ctx = document.getElementById('chart-termometro').getContext('2d');
						var chart = new Chart(ctx, {
							type: 'line',
							data: {
								labels: labels,
								datasets: [{
									label: 'Estado del termometro',
									data: data_values,
									backgroundColor: 'rgba(54, 162, 235, 0.2)',
									borderColor: 'rgba(54, 162, 235, 1)',
									borderWidth: 1
								}]
							},
							options: {
								scales: {
									yAxes: [{
										ticks: {
											beginAtZero: true
										}
									}]
								}
							}
						});
					}
				});
			});
		});
	</script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Control de dispositivos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" href="grafica_puerta">Historial de puerta</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Historial de termometro</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
	<h1 class="mb-3">Gráfica del termometro</h1>
	<form>
		<label for="fecha-inicio">Fecha de inicio:</label>
		<input type="date" id="fecha-inicio" name="fecha-inicio">
		<label for="fecha-fin">Fecha de fin:</label>
		<input type="date" id="fecha-fin" name="fecha-fin">
		<button type="button" id="grafica-termometro" class="btn btn-dark">Mostrar gráfica</button>
	</form>
	<div class="container"><canvas id="chart-termometro"></canvas></div>
</body>
</html>
