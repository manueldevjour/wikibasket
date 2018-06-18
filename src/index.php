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

	$usuario = $_SESSION["usuario"];

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Home - Wikibasket</title>
		<?php include("header.php"); ?>
		<!-- Archivos locales de estilos CSS -->
		<link rel="stylesheet" href="../css/index.css">
	</head>
	<body>
		<?php
			include("navbar.php");
		?>
		
		<div class="container">
			<!--Bienvenida-->
			<div class="row col-sm-12 text-center">
				<h3 class="user col-sm-12 text-center">Welcome <b><?= $usuario ?></b></h3>
			</div>
			<!--Comienza la row con los contenidos-->
			<div class="row">
				<!--Mapa-->
				<div id="map" class="col-12 col-lg-6">
					<div class="info"></div>
					<div class="legend"></div>
				</div><!--Fin del mapa y de la columna izquierda-->
				<!--Consulta de datos de equipos y jugadores-->
				<div class="col-12 col-lg-6 mx-auto queries my-5">
					<div class="row">
						<form action="team.php" method="get">
							<div class="row mx-auto">
								<!--Elección del equipo a consultar-->
								<div class="col-12 col-lg-6 my-2">
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
								<div class="col-12 col-lg-6 my-2">
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
										<button type="submit" class="btn btn-primary mx-auto my-3">Consultar</button>
									</div>
								</div>
							</div>
						</form>
					</div><!--Fin de la primera row de la columna derecha-->
					<div class="row">
						<div class="col-8 col-lg-8">
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
						<div class="col-4 col-lg-4">
						<button type="submit" class="btn btn-primary mx-auto">Consultar</button>
							</form>
						</div>
								
						
					</div><!--Fin de la primera row de la columna derecha-->
				</div><!--Fin de la columna derecha-->
				
			</div>
		</div><!--Fin del container principal del index-->
		<?php
			include("scripts.php"); 
		?>
		<!-- Archivo local de scripts -->
		<script src="../js/index.js"></script>
	</body>
</html>