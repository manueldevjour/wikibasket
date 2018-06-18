<?php

    require_once("databaseconnection.php");
    require_once("funciones.php");
    session_start() ;

    // Comprobamos si existe una sesión previa
    if (!isset($_SESSION["id"])) { 
        header("Location:login.php") ;
    }

    // Para poder salir de la sesión actual. Al no existir sesión, nos mandaría directamente al login para poder inicar sesión.
    if (isset($_GET["logout"])) {
        destruir_session(); 
    }


	if(isset($_GET["player"])) {
		$player_received = $_GET["player"];

		$consultaDatosJugador = "SELECT * FROM jugadores WHERE player_id = '$player_received'";
		$resultadoDatosJugador = $connectdb->query($consultaDatosJugador);
		$filaDatosJugador = $resultadoDatosJugador->fetch_object();
		$nombre = $filaDatosJugador->player_name;
		$first_name = $filaDatosJugador->first_name;
		$last_name = $filaDatosJugador->last_name;
		
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?= $nombre ?> - Wikibasket</title>
		<?php include("header.php"); ?>
		<!-- Archivos locales de estilos CSS -->
		<link rel="stylesheet" href="../css/players.css">
	</head>
	<body>
		<?php
			include("navbar.php");
			

			//Consulta para sacar datos del equipo donde juega el jugador seleccionado
			$consultaDatosEquipo = "SELECT * FROM jugadores, equipos WHERE jugadores.team_id = equipos.team_id AND jugadores.player_id = '$player_received'";
			$resultadoDatosEquipo = $connectdb->query($consultaDatosEquipo);
			$filaDatosEquipo = $resultadoDatosEquipo->fetch_object();
			$nombre_equipo = $filaDatosEquipo->team_name;
			$logo = $filaDatosEquipo->logo;

		?>
		
		<div class="container">
			<!--Primera row para el nombre y bandera del jugador-->
			<div class="row">
				<div class="col-12">
					<h4 class="nombre text-center my-2">
						<?= $nombre ?>
						<img src="<?= $logo ?>" title="<?= $nombre_equipo ?>" class="logo">
					</h4>
				</div>
			</div>
			<!--Segunda row con toda la info del jugador-->
			<div class="row">
				<div class="col-12 col-sm-4 my-2">
					<img src="https://nba-players.herokuapp.com/players/<?= $last_name ?>/<?= $first_name ?>" alt="Imagen del jugador" title="<?= $nombre ?>" class="img-player img-fluid img-thumbnail">
				</div>
				<!--Segunda columna con toda la info del jugador-->
				<div class="col-12 col-sm-4 text-center">
					<p class="birthday"></p>
					<p class="school"></p>
					<p class="place-birth"></p>
					<p class="last-affiliation"></p>
					<p class="height"></p>
					<p class="weight"></p>
					<p class="position"></p>
					<p class="experience"></p>
					<p class="jersey"></p>
				</div><!--Fin de la segunda columna-->
				<!--Tercera columna con la información media de su temporada-->
				<div class="col-12 col-sm-4">
					<h5 class="text-center nombre average-title">Average season stats</h5>
					<div class="nombre average">
						<p class="text-center my-3">Points</p>
						<h2 class="nombre average-points text-center"></h2>
					</div>
					<div class="nombre average">
						<p class="text-center my-3">Rebounds</p>
						<h2 class="nombre average-rebounds text-center"></h2>
					</div>
					<div class="nombre average">
						<p class="text-center my-3">Assists</p>
						<h2 class="nombre average-assists text-center"></h2>
					</div>
				</div><!--Fin de la tercera columna-->
			</div><!--Fin de la segunda row-->
			
			<!--Tercera row con toda la info del jugador temporada por temporada-->
			<div class="row">
				<div class="card w-100 mx-auto mt-5">
					<div class="card-header">
						<h5 class="nombre text-center">
							<button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#seasonsPlayedCollapse" aria-expanded="false" aria-controls="seasonsPlayedCollapse">
								Stats season by season
							</button>
						</h5>
					</div><!--Fin del card-header-->
					<div class="collapse" id="seasonsPlayedCollapse">
						<div class="card-body">
							<h5 class="nombre text-center">Stats season by season</h5>
							<table class="table table-bordered table-hover table-responsive text-center">
								<thead class="thead-dark">
									<tr class="nombre">
									<th scope="col">Season</th>
									<th scope="col">Team</th>
									<th scope="col">Games played</th>
									<th scope="col">Games started</th>
									<th scope="col">Minutes played</th>
									<th scope="col">FGM, FGA and %</th>
									<th scope="col">FG3M, FG3A and %</th>
									<th scope="col">T rebounds</th>
									<th scope="col">T assists</th>
									<th scope="col">T steals</th>
									<th scope="col">T blocks</th>
									<th scope="col">T points</th>
									</tr>
								</thead>
								<tbody class="cuerpoTablaDatosJugador">
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!--Cuarta  row con toda la info del jugador temporada por temporada-->
			<div class="row">
				<div class="card w-100 mx-auto my-2">
					<div class="card-header">
						<h5 class="nombre text-center">
							<button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#seasonHighsCollapse" aria-expanded="false" aria-controls="seasonHighsCollapse">
								Season 17-18 highs
							</button>
						</h5>
					</div><!--Fin del card-header-->
					<div class="collapse" id="seasonHighsCollapse">
						<div class="card-body">
							<h5 class="nombre text-center">Highs - Season 17-18</h5>
							<table class="table table-bordered table-hover text-center">
								<thead class="thead-dark">
									<tr class="nombre">
										<th scope="col">Date</th>
										<th scope="col">vs team</th>
										<th scope="col">Stat</th>
										<th scope="col">Value</th>
									</tr>
								</thead>
								<tbody class="cuerpoTablaSeasonHighs">
									
								</tbody>
							</table>
						</div>
					</div>
				</div><!--Fin del card con los mejores stats de la temporada-->
			</div><!--Fin de la cuarto row de los mejores stats de la temporada-->
			<!--Quinta row con las mejores stats de la carrera del jugador-->
			<div class="row">
				<div class="card w-100 mx-auto my-2">
					<div class="card-header">
						<h5 class="nombre text-center">
							<button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#careerHighsCollapse" aria-expanded="false" aria-controls="careerHighsCollapse">
								Career highs
							</button>
						</h5>
					</div><!--Fin del card-header-->
					<div class="collapse" id="careerHighsCollapse">
						<div class="card-body">
							<h5 class="nombre text-center">Career highs</h5>
							<table class="table table-bordered table-hover text-center">
								<thead class="thead-dark">
									<tr class="nombre">
										<th scope="col">Date</th>
										<th scope="col">vs team</th>
										<th scope="col">Stat</th>
										<th scope="col">Value</th>
									</tr>
								</thead>
								<tbody class="cuerpoTablaCareerHighs">
									
								</tbody>
							</table>
						</div>
					</div>
				</div><!--Fin del card con las mejores stats de la carrera del jugador-->
			</div><!--Fin de la row de las mejores stats de la carrera del jugador-->
			<!--Última row para hacer otra consulta-->
			<div class="row">
				<div class="card w-100 mx-auto my-2">
					<div class="card-header">
						<h5 class="nombre text-center">
							<button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#anotherQueryForPlayer" aria-expanded="false" aria-controls="anotherQueryForPlayer">
								Make another query?
							</button>
						</h5>
					</div><!--Fin del card-header-->
					<div class="collapse" id="anotherQueryForPlayer">
						<div class="card-body">
							<div class="row">
								<div class="col-7 col-md-4 mx-auto">
									<form action="players.php" method="get">
										<div class="input-group">
											<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
											<select name="player" class="custom-select px-2" required>
												<option value="" disabled selected>Choose player</option>
												<?php
													$consulta = $connectdb->query("SELECT * FROM jugadores ORDER BY player_name");
													while($resultadoJugador = $consulta->fetch_object()) {
														echo '<option value="' .$resultadoJugador->player_id. '">' .$resultadoJugador->player_name. '</option>';
													}
												?>
											</select>
										</div>
								</div>
								<div class="col-4 col-md-2 mx-auto">
								<button type="submit" class="nombre btn btn-primary mx-auto">Query</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div><!--Fin del card con las mejores stats de la carrera del jugador-->
			</div><!--Fin de la row de las mejores stats de la carrera del jugador-->
        </div><!--Fin del container-->
		
		<?php include("scripts.php"); ?>
		<!-- Archivo local de scripts -->
		<script src="../js/players.js"></script>
		<script type="text/javascript">var player_received = "<?= $player_received ?>";</script>
	</body>
</html>