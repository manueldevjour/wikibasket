<?php

	require_once("funciones.php");
	require_once("databaseconnection.php");
	session_start() ;
	
	// Comprobamos si existe una sesión previa
	if (!isset($_SESSION["id"])) { 
		header("Location:login.php") ;
	}

	// Para poder salir de la sesión actual. Al no existir sesión, nos mandaría directamente al login para poder inicar sesión.
	if (isset($_GET["logout"])) {
		destruir_session(); 
	}

	
	if(isset($_GET["team"], $_GET["season"])) {
		$team_received = $_GET["team"];
		$season_received = $_GET["season"];

        $consultaDatosEquipo = "SELECT equipos.*, conferencia.* FROM equipos, conferencia WHERE equipos.conferencia_id = conferencia.id_conferencia AND equipos.team_id = '$team_received';";
		$resultadoDatosEquipo = $connectdb->query($consultaDatosEquipo);
		$fila = $resultadoDatosEquipo->fetch_object();
		$nombre = $fila->team_name;
		$logo = $fila->logo;
		$latitud = $fila->latitud;
		$longitud = $fila->longitud;
		$nombre_estadio = $fila->nombre_estadio;
		$imagen_estadio = $fila->imagen_estadio;
		$pais = $fila->pais;
		$estado = $fila->nombre_estado;
		$estado_iso = $fila->estado_iso;
		$ciudad = $fila->city;
		$nombre_conferencia = $fila->conferencia;
		$imagen_conferencia = $fila->imagen;
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?= $nombre ?> in <?= $season_received ?> - Wikibasket</title>
		<?php include("header.php"); ?>
		<!-- Archivos locales de estilos CSS -->
		<link rel="stylesheet" href="../css/team.css">
	</head>
	<body>
		<?php
			include("navbar.php");
			
			

		?>
		<div class="container">
			<div class="row">
				<!--Card de presentación del equipo-->
				<div class="card w-100 mx-auto my-2">
					<div class="card-body">
						<h5 class="card-title text-center nombre"><?= $nombre ?><img src="http://www.countryflags.io/<?= $pais ?>/shiny/24.png" class="ml-1" title="País de origen"></h5>
						
						<hr>
						<div class="row">
							<!--Columna izquierda-->
							<div class="col-12 col-sm-4 text-center">
								<img src="<?= $logo ?>" alt="Logo de <?= $nombre ?>" title="Logo de <?= $nombre ?>" class="logo-equipo card-img-left">
								<img src="<?= $imagen_conferencia ?>" alt="Logo de la conferencia <?= $nombre_conferencia ?>" title="Logo de la conferencia <?= $nombre_conferencia ?>" class="logo-conferencia card-img-left">
								<p class="text-center my-2"><strong class="first-year-style">First year in the NBA </strong><i class="fa fa-arrow-right"></i><span class="first-year"> </span></p>
								<div class="ranking">
									<h4 class="nombre text-center my-3">League's ranking</h4>
									<p class="division-ranking"></p>
									<p class="conference-ranking"></p>
								</div>
								<div class="average-stats">
									<h4 class="title nombre text-center mt-3">Average & Ranking stats</h4>
									<h6 class="nombre text-center mt-1 mb-3">(per game)</h6>
									<p class="nombre">
										<strong>Points</strong>
										<p>
											<span class="nombre points-average"></span>
											<span>-</span>
											<span class="nombre points-ranking"></span>
										</p>
									</p>
									<p class="nombre">
									<strong>Rebounds</strong>
										<p>
											<span class="nombre rebounds-average"></span>
											<span>-</span>
											<span class="nombre rebounds-ranking"></span>
										</p>
									</p>
									<p class="nombre">
										<strong>Assists</strong>
										<p>
											<span class="nombre assists-average"></span>
											<span>-</span>
											<span class="nombre assists-ranking"></span>
										</p>
									</p>
								</div>
							</div>
							<!--Columna central-->
							<div class="col-12 col-sm-4 text-center">
								<p class="season"></p>
								<p class="entrenador-principal"></p>
								<p>
									<p class="text-center mx-auto ciudad-origen w-75"><strong>Hometown</strong></p>
									<p class="city text-center"></p>
									<div class="row">
										<img src="http://flags.ox3.in/svg/<?= $pais ?>/<?= $estado_iso ?>/<?= $ciudad ?>.svg" title ="Hometown's flag" class="city-flag img-fluid img-thumbnail mx-auto my-2">
									</div>
									
								</p>
								<p class="conference"></p>
								<p class="division"></p>
								<p>
									<h6 class="text-center text-muted results w-75 mx-auto">Season's balance</h6>
									<div class="row">
										<div class="col text-center">
											<span class="victories mx-1">W: </span>
											<span class="defeats mx-1">L: </span>
										</div>
									</div>
									<div class="row">
										<div class="col text-center">
											<span class="percentage"></span>%<span class="text-muted">WR</span>
										</div>
									</div>
									<div class="row">
										<img src="http://flags.ox3.in/svg/<?= $pais ?>/<?= $estado_iso ?>.svg" class="state-flag mx-auto my-2 img-fluid img-thumbnail" title="<?= $estado ?>'s flag">
									</div>
									
								</p>
							</div>
							<!--Columna derecha-->
							<div class="col-12 col-sm-4">
								<div class="mapInfo">
									<input type="text" value="<?= $latitud ?>" id="latitud" hidden></input>
									<input type="text" value="<?= $longitud ?>" id="longitud" hidden></input>
									<div id="userMap"></div>
										<p class="text-muted text-center mt-1"><?= $nombre_estadio ?></p>
								</div><!--Cierre del mapa-->
								<div class="row">
									<button class="btn btn-outline-primary mx-auto" type="button" data-toggle="collapse" data-target="#myCollapsibleOfStadium" aria-expanded="false" aria-controls="myCollapsibleOfStadium">
										See image of the stadium
									</button>
								</div>
								<div class="collapse my-1" id="myCollapsibleOfStadium">
									<img src="<?= $imagen_estadio ?>" alt="" class="img-fluid img-thumbnail stadium my-1">
								</div><!--Collapse para la imagen del estadio-->
							</div><!--Cierre de la columna derecha-->
						</div><!--Cierre de la row-->
					</div><!--Cierre del cuerpo de la card-->
				</div><!--Cierre de la card-->
			</div><!--Cierre de la primera row-->
			<div class="row">
				<div class="col-12">
					<div id="accordion" class="w-100">
						<div class="card w-100 my-2">
							<div class="card-header" id="headingOne">
								<h5 class="nombre text-center">
									<button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
										Make another query?
									</button>
								</h5>
							</div><!--Fin del card-header-->
							<!--Todo el contenido del collapse-->
							<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
								<!--Card body completo-->
								<div class="card-body">
									<div class="row">
										<div class="col-12 col-md-6 consultar mx-auto">
											<form action="team.php" method="get">
												<div class="row">
													<!--Elección del equipo a consultar-->
													<div class="col-12 my-2">
														<div class="input-group">
															<span class="input-group-text"><i class="fa fa-basketball-ball" aria-hidden="true"></i></span>
															<select name="team" class="custom-select px-2" required>
																<option value="" disabled selected>Choose team</option>
																<?php
																	$consulta = $connectdb->query("SELECT * FROM equipos ORDER BY team_name");
																	while($resultadoEquipo = $consulta->fetch_object()) {
																		echo '<option value="' .$resultadoEquipo->team_id. '">' .$resultadoEquipo->team_name.'</option>';
																	}
																?>
															</select>
														</div>
													</div>
													<!--Elección de la temporada a consultar-->
													<div class="col-12 my-2">
														<div class="input-group">
															<span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
															<select name="season" class="custom-select px-2" required>
																<option value="" disabled selected>Choose season</option>
																<?php
																	$consulta = $connectdb->query("SELECT * FROM temporadas ORDER BY id_temporada");
																	while($resultadoTemporada = $consulta->fetch_object()) {
																		echo '<option value="' .$resultadoTemporada->temporada. '">' .$resultadoTemporada->temporada.'</option>';
																	}
																?>
															</select>
														</div>
													</div>
												</div>
												<!--Row para el submit de la consulta-->
												<div class="row">
													<div class="col">
														<div class="input-group">
															<button type="submit" class="btn btn-primary mx-auto my-3">Query</button>
														</div>
													</div>
												</div>
											</form><!--Cierre del form para la consulta de otro equipo nuevo-->
										</div><!--Div para el cierre de la columna-->
									</div><!--Div para el cierre de la row-->
								</div><!--Div para el cierre del card body-->
							</div><!--Cierre del collapse-->
						</div><!--Div para el cierre del card-->
					</div><!--Cierre del acordeón uno-->
				</div><!--Div para el cierre de la única columna de la segunda row-->
			</div><!--Div para el cierre de la segunda row-->
			<!--Row para los entrenadores-->
			<div class="row">
				<!--Card de presentación del cuerpo técnico-->
				<div class="card w-100 mx-auto my-2">
					<div class="card-header" id="headingStaff">
						<h5 class="nombre text-center">
							<button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#staffCollapse" aria-expanded="false" aria-controls="staffCollapse">
								Technical staff
							</button>
						</h5>
					</div><!--Fin del card-header-->
					<div class="collapse" id="staffCollapse">
						<div class="card-body">
							<h5 class="card-title text-center nombre">Technical staff</h5>
							<table class="table table-bordered table-hover text-center">
								<thead class="thead-dark">
									<tr>
									<th class="nombre" scope="col">Position</th>
									<th class="nombre" scope="col">Name</th>
									<th class="nombre" scope="col">School</th>
									</tr>
								</thead>
								<tbody class="cuerpoTablaTrainers">

								</tbody>
								</table>
						</div>
					</div>
				</div>
			</div>
			<!--Row para los jugadores-->
			<div class="row">
				<!--Card de presentación del roster-->
				<div class="card w-100 mx-auto my-2">
					<div class="card-header" id="headingStaff">
						<h5 class="nombre text-center">
							<button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#rosterCollapse" aria-expanded="false" aria-controls="rosterCollapse">
								Team roster
							</button>
						</h5>
					</div><!--Fin del card-header-->
					<div class="collapse" id="rosterCollapse">
						<div class="card-body">
							<h5 class="card-title text-center nombre">Team roster of the season <?= $season_received ?></h5>
							<table class="table table-bordered table-hover table-responsive w-100 text-center">
								<thead class="thead-dark">
									<tr>
									<th class="nombre" scope="col">Player</th>
									<th class="nombre" scope="col">Jersey</th>
									<th class="nombre" scope="col">Position</th>
									<th class="nombre" scope="col">Height</th>
									<th class="nombre" scope="col">Weight</th>
									<th class="nombre" scope="col">Birth date</th>
									<th class="nombre" scope="col">Age</th>
									<th class="nombre" scope="col">Years in the NBA</th>
									<th class="nombre" scope="col">School</th>
									</tr>
								</thead>
								<tbody class="cuerpoTablaRoster">

								</tbody>
								</table>
						</div>
					</div>
				</div>
			</div>
			<!--Nueva row para todos los partidos de la temporada-->
			<div class="row">
				<div class="card w-100 mx-auto my-2">
					<div class="card-header" id="headingOne">
						<h5 class="nombre text-center">
							<button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#seasonGamesCollapse" aria-expanded="false" aria-controls="seasonGamesCollapse">
								Games of the season <?= $season_received ?>
							</button>
						</h5>
					</div><!--Fin del card-header-->
					<div class="collapse" id="seasonGamesCollapse">
						<div class="card-body">
							<table class="table table-bordered table-hover table-responsive text-center">
								<thead class="thead-dark">
									<tr class="nombre">
									<th scope="col">Date</th>
									<th scope="col">Match</th>
									<th scope="col">Result (W/L)</th>
									<th scope="col">League (W/L)</th>
									<th scope="col">Win percentage</th>
									<th scope="col">Field goals made, attempted and %</th>
									<th scope="col">T rebounds</th>
									<th scope="col">T assists</th>
									<th scope="col">T steals</th>
									<th scope="col">T blocks</th>
									<th scope="col">T points</th>
									</tr>
								</thead>
								<tbody class="cuerpoTablaPartidos">
									
								</tbody>
								</table>
						</div>
					</div>
				</div><!--Fin del card con los partidos de la temporada-->
			</div><!--Fin de la row de los partidos de la temporada-->
			<div class="row">
				<div class="card w-100 mx-auto my-2">
				<div class="card-header" id="headingTwo">
					<h5 class="nombre text-center">
						<button class="btn btn-primary collapsed" data-toggle="collapse" data-target="#lastSeasonPlayersCollapse" aria-expanded="false" aria-controls="lastSeasonPlayersCollapse">
							Players of the season 17-18
						</button>
					</h5>
					</div><!--Fin del card-header-->
					<div class="collapse" id="lastSeasonPlayersCollapse">
						<div class="card-body">
							<table class="table table-bordered table-hover text-center">
								<thead class="thead-dark">
									<tr>
									<th class="nombre" scope="col">Name</th>
									<th class="nombre" scope="col">Query</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$consultaJugadoresEquipo = $connectdb->query("SELECT equipos.*, conferencia.*, jugadores.* FROM equipos, conferencia, jugadores WHERE equipos.conferencia_id = conferencia.id_conferencia AND jugadores.team_id = equipos.team_id AND equipos.team_id = '$team_received' ORDER BY jugadores.player_name;");
										while($resultadoJugadoresEquipo = $consultaJugadoresEquipo->fetch_object()) {
											echo '<tr>';
											echo '<td><h6>' .$resultadoJugadoresEquipo->player_name. '</h6></td>';
											echo '<td><a href="players.php?player=' .$resultadoJugadoresEquipo->player_id. '"class="btn btn-primary">Check data</a></td>';
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div><!--Fin del card con los jugadores que tiene el equipo-->
			</div><!--Fin de la row para los datos de los jugadores-->
		</div><!--Cierre del container-->
		
		
		<?php include("scripts.php"); ?>
		<!-- Archivo local de scripts -->
		<script src="../js/team.js"></script>
		<script type="text/javascript">var team_received = "<?= $team_received ?>";
		var season_received = "<?= $season_received ?>";</script>
		

		<!--Creación del mapa, con las coordenadas que se le pasan de la base de datos y se almacenan en los inputs.-->
		<script>
			function initMap() {
				var latitud = parseFloat(document.getElementById("latitud").value);
				var longitud = parseFloat(document.getElementById("longitud").value);
        		var mapita = {lat: latitud, lng: longitud};
        		var map = new google.maps.Map(document.getElementById('userMap'), {
          			zoom: 14,
		  			center: mapita,
		  			styles: [
						{elementType: 'geometry', stylers: [{color: '#ebe3cd'}]},
						{elementType: 'labels.text.fill', stylers: [{color: '#523735'}]},
						{elementType: 'labels.text.stroke', stylers: [{color: '#f5f1e6'}]},
						{
							featureType: 'administrative',
							elementType: 'geometry.stroke',
							stylers: [{color: '#c9b2a6'}]
						},
						{
							featureType: 'administrative.land_parcel',
							elementType: 'geometry.stroke',
							stylers: [{color: '#dcd2be'}]
						},
						{
							featureType: 'administrative.land_parcel',
							elementType: 'labels.text.fill',
							stylers: [{color: '#ae9e90'}]
						},
						{
							featureType: 'landscape.natural',
							elementType: 'geometry',
							stylers: [{color: '#dfd2ae'}]
						},
						{
							featureType: 'poi',
							elementType: 'geometry',
							stylers: [{color: '#dfd2ae'}]
						},
						{
							featureType: 'poi',
							elementType: 'labels.text.fill',
							stylers: [{color: '#93817c'}]
						},
						{
							featureType: 'poi.park',
							elementType: 'geometry.fill',
							stylers: [{color: '#a5b076'}]
						},
						{
							featureType: 'poi.park',
							elementType: 'labels.text.fill',
							stylers: [{color: '#447530'}]
						},
						{
							featureType: 'road',
							elementType: 'geometry',
							stylers: [{color: '#f5f1e6'}]
						},
						{
							featureType: 'road.arterial',
							elementType: 'geometry',
							stylers: [{color: '#fdfcf8'}]
						},
						{
							featureType: 'road.highway',
							elementType: 'geometry',
							stylers: [{color: '#f8c967'}]
						},
						{
							featureType: 'road.highway',
							elementType: 'geometry.stroke',
							stylers: [{color: '#e9bc62'}]
						},
						{
							featureType: 'road.highway.controlled_access',
							elementType: 'geometry',
							stylers: [{color: '#e98d58'}]
						},
						{
							featureType: 'road.highway.controlled_access',
							elementType: 'geometry.stroke',
							stylers: [{color: '#db8555'}]
						},
						{
							featureType: 'road.local',
							elementType: 'labels.text.fill',
							stylers: [{color: '#806b63'}]
						},
						{
							featureType: 'transit.line',
							elementType: 'geometry',
							stylers: [{color: '#dfd2ae'}]
						},
						{
							featureType: 'transit.line',
							elementType: 'labels.text.fill',
							stylers: [{color: '#8f7d77'}]
						},
						{
							featureType: 'transit.line',
							elementType: 'labels.text.stroke',
							stylers: [{color: '#ebe3cd'}]
						},
						{
							featureType: 'transit.station',
							elementType: 'geometry',
							stylers: [{color: '#dfd2ae'}]
						},
						{
							featureType: 'water',
							elementType: 'geometry.fill',
							stylers: [{color: '#b9d3c2'}]
						},
						{
							featureType: 'water',
							elementType: 'labels.text.fill',
							stylers: [{color: '#92998d'}]
						}
					]
        		});
        		var marker = new google.maps.Marker({
          			position: mapita,
          			map: map
        		});
	  		}
		</script>
		<script async defer
    		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCN0MITVQVkxOb6ejjvK_CCxFmE-tRTj00&callback=initMap">
		</script>
	</body>
</html>