<?php
	require_once("databaseconnection.php");
	require_once("funciones.php");
	session_start() ;
	
	// Comprobamos si existe una sesión previa
	if (!isset($_SESSION["id"])) { 
		header("Location:login.php") ;
	}

    if (isset($_GET["logout"])) {
		destruir_session() ; 
	}

	if (isset($_GET["eliminarcuenta"])) {
		eliminar_cuenta() ; 
	}
	
	$usuario = $_SESSION["usuario"];

	//Realizamos la consulta para sacar los usuarios que tenemos
	$consulta = "SELECT * FROM usuarios";
	
	$resultado = $connectdb->query($consulta);

	//Operación para el cambio de nombre de usuario
	if(isset($_POST["usuario"])) {
		$usuario_nuevo = $connectdb->real_escape_string($_POST["usuario"]);
		$query = $connectdb->query("UPDATE usuarios SET usuario = '$usuario_nuevo' WHERE usuario = '$usuario';");
		$usuario_nuevo = $usuario;
		$usuario = $_SESSION["usuario"];
		$cambioCorrectoUsuario = "<div class=\"alert alert-success alert-dismissible fade show mt-2 text-center\" role=\"alert\">
		El nombre de usuario ha sido modificado correctamente<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
		<span aria-hidden=\"true\">&times;</span></button></div>";
	}


	//Operación para el cambio de contraseña
	if(isset($_POST["contrasena"])){
        $contrasena = $connectdb->real_escape_string(md5($_POST["contrasena"]));
        $confirmarContrasena = $connectdb->real_escape_string(md5($_POST["confirmarContrasena"]));

        if($contrasena == $confirmarContrasena) {
            $query = $connectdb->query("UPDATE usuarios SET contrasena = '$contrasena' WHERE usuario = '$usuario';");
			$cambioCorrectoContrasena = "<div class=\"alert alert-success alert-dismissible fade show mt-2 text-center mx-auto\" role=\"alert\">
			La contraseña ha sido modificada correctamente<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
			<span aria-hidden=\"true\">&times;</span></button></div>";
        } else {
            $errorCambioContrasena = "<div class=\"alert alert-danger alert-dismissible fade show mt-2 text-center mx-auto\" role=\"alert\">
			<strong>Error</strong> Las contraseñas no coinciden<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
			<span aria-hidden=\"true\">&times;</span></button></div>";
		}
	}

	//Operación para el cambio de email
	if(isset($_POST["email"])) {
		$email = $connectdb->real_escape_string($_POST["email"]);
		$query = $connectdb->query("UPDATE usuarios SET email = '$email' WHERE usuario = '$usuario';");
		$cambioCorrectoEmail = "<div class=\"alert alert-success alert-dismissible fade show mt-2 text-center\" role=\"alert\">
		El email ha sido modificado correctamente<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
		<span aria-hidden=\"true\">&times;</span></button></div>";
	}

	//Operación para el cambio de nombre
	if(isset($_POST["nombre_completo"])) {
		$nombre_completo = $connectdb->real_escape_string($_POST["nombre_completo"]);
		$query = $connectdb->query("UPDATE usuarios SET nombre_completo = '$nombre_completo' WHERE usuario = '$usuario';");
		$cambioCorrectoNombre = "<div class=\"alert alert-success alert-dismissible fade show mt-2 text-center\" role=\"alert\">
		Su nombre ha sido modificado correctamente.<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
		<span aria-hidden=\"true\">&times;</span></button></div>";
	}

	//Operación para el cambio de fecha de nacimiento
	if(isset($_POST["fecha_nacimiento"])) {
		$fecha_nacimiento = $connectdb->real_escape_string($_POST["fecha_nacimiento"]);
		$query = $connectdb->query("UPDATE usuarios SET fecha_nacimiento = '$fecha_nacimiento' WHERE usuario = '$usuario';");
		$cambioCorrectoFecha = "<div class=\"alert alert-success alert-dismissible fade show mt-2 text-center\" role=\"alert\">
		Su fecha de nacimiento ha sido modificada correctamente.<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
		<span aria-hidden=\"true\">&times;</span></button></div>";
	}
	
	//Operación para el cambio de país
	if(isset($_POST["pais_origen"])) {
		$pais_origen = $connectdb->real_escape_string($_POST["pais_origen"]);
		$query = $connectdb->query("UPDATE usuarios SET id_pais = '$pais_origen' WHERE usuario = '$usuario';");
		$cambioCorrectoPais = "<div class=\"alert alert-success alert-dismissible fade show mt-2 text-center\" role=\"alert\">
		Su país de origen ha sido modificado correctamente.<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
		<span aria-hidden=\"true\">&times;</span></button></div>";
	}

	//Operación para el cambio de equipo
	if(isset($_POST["equipo_favorito"])) {
		$equipo_favorito = $connectdb->real_escape_string($_POST["equipo_favorito"]);
		$query = $connectdb->query("UPDATE usuarios SET id_franquicia = '$equipo_favorito' WHERE usuario = '$usuario';");
		$cambioCorrectoEquipo = "<div class=\"alert alert-success alert-dismissible fade show mt-2 text-center\" role=\"alert\">
		Su equipo favorito ha sido modificado correctamente.<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
		<span aria-hidden=\"true\">&times;</span></button></div>";
	}

	
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title></title>
		<?php include("header.php"); ?>
		<!-- Archivos locales de estilos CSS -->
		<link rel="stylesheet" href="../css/perfil.css">
	</head>
	<body>
		<?php
			include("navbar.php");
		?>
		<div class="container">
			<?php
				$comprobacionAdmin = $connectdb->query("SELECT administrador FROM usuarios WHERE usuario = '$usuario';");
				$filaAdministrador = $comprobacionAdmin->fetch_object();
				if($filaAdministrador->administrador == 1) {
			?>
					<h3 class="perfiladmin">A D M I N  P A N E L</h3>
					<h5 class="perfiladmin">Here you have a list of every user registered on your webpage.</h5>
					<p class="perfiladmin">If you consider, you can delete any account.</p>
					<table class="tabla table-bordered text-center mb-5" id="tablausuarios">
						<tr class="nombre">
							<th>User</th>
							<th>Email</th>
							<th>Full name</th>
							<th>Birth date</th>
							<th>Admin?</th>
							<th>Actions</th>
						</tr>
						
						<?php
							while($fila = $resultado->fetch_object()) {?>
							<tr id="<?= $fila->usuario ?>">
								<td class="usuario"><?=$fila->usuario?></td>
								<td class="email"><?=$fila->email?></td>
								<td class="nombre_completo"><?=$fila->nombre_completo?></td>
								<td class="fecha_nacimiento"><?=$fila->fecha_nacimiento?></td>
								<td class="administrador"><?=$fila->administrador?></td>
								<td>
									<button class="btn btn-outline-danger boton-eliminar"><i class="material-icons">gavel</i></button>
								</td>
								
							</tr>
							<?php } //Final del while?>
						
					</table><hr>
					<!-- Parte de vista del usuario -->
			<?php }  
				$comprobacionUsuario = $connectdb->query("SELECT usuarios.*, paises.*, equipos.* FROM usuarios, paises, equipos WHERE usuarios.id_pais = paises.id_pais AND usuarios.id_franquicia = equipos.team_id AND usuarios.usuario = '$usuario'");
				$filaUsuario = $comprobacionUsuario->fetch_object();
				$fechaDeNacimiento = $filaUsuario->fecha_nacimiento;
				$paisOrigen = $filaUsuario->nombrebonitoingles;
				$nombreCompleto = $filaUsuario->nombre_completo;
				$equipoFavoritoId = $filaUsuario->team_id;
				$equipoFavorito = $filaUsuario->team_name;
			?>
			<div class="row">
				<!--Div para los ajustes-->
				<div class="col-12 col-md-6">
					<h2 class="ajustes text-center">Settings</h2>
					<div class="row">
						<!--Div para los botones de colapsables-->
						<div class="mx-auto my-3">
							<!--Botón del colapsable para el cambio de nombre de usuario-->
							<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#myCollapsibleOfUsername" aria-expanded="false" aria-controls="myCollapsibleOfUsername">
								Change username
							</button>
							<!--Botón del colapsable para el cambio de contraseña-->
							<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#myCollapsibleOfPassword" aria-expanded="false" aria-controls="myCollapsibleOfPassword">
								Change password
							</button>
							<!--Botón del colapsable para el cambio de email-->
							<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#myCollapsibleOfEmail" aria-expanded="false" aria-controls="myCollapsibleOfEmail">
								Change email
							</button>
						</div><!--Fin del div de los botones de colapsables-->
						
						
						<!--Div para el colapsable de cambio de nombre de usuario-->
						<div class="collapse multi-collapse" id="myCollapsibleOfUsername">
							<!--Formulario para el cambio de nombre de usuario-->
							<form method="post" class="mx-3 my-2">
								<div class="row">
									<div class="col-7">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">New username</span>
											</div>
											<input type="text" name="usuario" id="usuario" class="usuario form-control px-1 text-center" placeholder="<?= $usuario ?>" value="<?= $usuario?>">
										</div>
									</div>
									<div class="col-4">
										<button type="submit" class="btn btn-outline-success mx-auto">Change name</button>
									</div>
								</div>
							</form><!--Fin del formulario para el cambio de nombre de usuario-->
						</div><!--Fin del colapsable para el cambio de nombre de usuario-->
						<!--Control de notificaciones para OK/KO de cambio de nombre de usuario-->

						<!--Div para el collapsable de cambio de contraseña-->
						<div class="collapse multi-collapse mx-auto" id="myCollapsibleOfPassword">
							<!-- Formulario para el cambio de contraseña -->
							<form method="post" class="mx-3 my-2">
								<div class="row">
									<div class="col">
										<div class="input-group mx-auto">
											<span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
											<input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Nueva contraseña" minlength="6" required>
										</div>
									</div>
								</div>
								<div class="row my-2">
									<div class="col">
										<div class="input-group">
											<span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
											<input type="password" name="confirmarContrasena" id="confirmarContrasena" class="form-control" placeholder="Repite la contraseña" minlength="6" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-4">
										<button type="submit" class="btn btn-outline-success mx-5 my-3">Change password</button>
									</div>
								</div>
							</form><!-- Fin del formulario del cambio de contraseña -->
						</div><!--Fin del colapsable para el cambio de contraseña-->
						<!--Control de notificaciones para OK/KO de cambio de datos-->
						<?=isset($cambioCorrectoContrasena) ? $cambioCorrectoContrasena : "" ; ?>
						<?=isset($errorCambioContrasena) ? $errorCambioContrasena : "" ; ?>
						
						<!--Div para el collapsable de cambio de email-->
						<div class="collapse multi-collapse" id="myCollapsibleOfEmail">
							<!--Formulario para el cambio de email-->
							<form method="post" class="mx-3 my-2">
								<div class="row">
									<div class="col-8">
										<div class="input-group">
											<span class="input-group-text"><i class="fa fa-at" aria-hidden="true"></i></span>
											<input type="email" name="email" id="email" class="form-control" placeholder="Nuevo email" required>
										</div>
									</div>
									<div class="col-4">
										<button type="submit" class="btn btn-outline-success mx-auto">Change email</button>
									</div>
								</div>
							</form>
						</div>
						<!--Control de notificaciones para OK/KO de cambio de datos-->
						<?=isset($cambioCorrectoEmail) ? $cambioCorrectoEmail : "" ; ?>
						<?=isset($errorCambioEmail) ? $errorCambioEmail : "" ; ?>
						
					</div>
					<!--Datos personales-->
					<h6 class="ajustes text-center">Personal information</h6>
					<!--Cambio de nombre-->
					<form method="post">
						<div class="row">
							<div class="col-7">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Full name</span>
									</div>
									<input type="text" name="nombre_completo" id="nombre_completo" class="nombre_completo form-control px-1 text-center" placeholder="<?= $nombreCompleto ?>" value="<?= $nombreCompleto?>">
								</div>
							</div>
							<div class="col-4">
								<button type="submit" class="btn btn-outline-success mx-auto">Change name</button>
							</div>
						</div>
					</form>
					<?=isset($cambioCorrectoNombre) ? $cambioCorrectoNombre : "" ; ?>

					<!--Cambio de fecha de nacimiento-->
					<form method="post" class="mt-4">
						<div class="row">
							<div class="col-7">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Birth date</span>
									</div>
									<input type="text" name="fecha_nacimiento" id="fecha_nacimiento" class="fecha_nacimiento form-control px-1 text-center" placeholder="<?= $fechaDeNacimiento ?>" value="<?= $fechaDeNacimiento ?>">
								</div>
							</div>
							<div class="col-4">
								<button type="submit" class="btn btn-outline-success mx-auto">Change date</button>
							</div>
						</div>
					</form>
					<?=isset($cambioCorrectoFecha) ? $cambioCorrectoFecha : "" ; ?>
					<!--Row para el país de origen-->
					<div class="row mt-4">
						<div class="col-12">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" for="pais_origen">Your country of origin is <?= $paisOrigen ?>
										<button type="button" class="btn btn-secondary btn-flag" data-toggle="tooltip" data-placement="bottom" title="Bandera de <?= $filaUsuario->nombrebonitoingles ?>">
											<img src="http://www.countryflags.io/<?= $filaUsuario->iso ?>/shiny/24.png" alt="Flag">
										</button>
									</span>
								</div>
							</div>
						</div>
					<div class="row w-100">
						<div class="col-12 col-sm-4 mx-auto my-2">
							<button class="btn btn-primary py-2" type="button" data-toggle="collapse" data-target="#myCollapsibleOfCountry" aria-expanded="false" aria-controls="myCollapsibleOfCountry">
								Change
							</button>
						</div>
					</div>
						
					</div>

					<div class="collapse" id="myCollapsibleOfCountry">
						<!-- Formulario para el cambio de país -->
						<form method="post" class="mt-4">
							<div class="row">
								<div class="col-6">
									<div class="input-group">
										<span class="input-group-text"><i class="fa fa-globe" aria-hidden="true"></i></span>
										<select name="pais_origen" class="custom-select px-1">
											<option value="" disabled selected>Choose country</option>
											<?php
												$consultaPais = $connectdb->query("SELECT id_pais, nombrebonitoingles, iso FROM paises ORDER BY nombrebonitoingles");
												while($resultadoPais = $consultaPais->fetch_object()) {
													echo '<option value="' .$resultadoPais->id_pais. '">' .$resultadoPais->nombrebonitoingles.'</option>';
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-4">
									<button type="submit" class="btn btn-outline-success mx-auto">Change country</button>
								</div>
							</div>
						</form><!-- Fin del formulario del cambio de país -->
					</div>
					<?=isset($cambioCorrectoPais) ? $cambioCorrectoPais : "" ; ?>
				
					<!--Equipo favorito-->
					<div class="row mt-4">
						<div class="col-12 col-lg-8">
							<div class="input-group">
								<div class="input-group-prepend mr-1">
									<span class="input-group-text">
										<i class="fa fa-star mr-1" aria-hidden="true" id="star"></i>
										<span>Your favorite team is <a href="team.php?team=<?= $equipoFavoritoId ?>&season=2017-18" class"favorite-team"> <?= $equipoFavorito ?></a></span>
									</span>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-3">
							<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#myCollapsibleOfTeam" aria-expanded="false" aria-controls="myCollapsibleOfTeam">
								Change
							</button>
						</div>
					</div>
					<!--Colapsable para el formulario de cambio de equipo favorito-->
					<div class="collapse" id="myCollapsibleOfTeam">
						<!--Formulario para el cambio de equipo favorito-->
						<form method="post" class="mt-4">
							<div class="row">
								<div class="col-6">
									<div class="input-group">
										<span class="input-group-text"><i class="fa fa-basketball-ball" aria-hidden="true"></i></span>
										<select name="equipo_favorito" class="custom-select px-1">
											<option value="" disabled selected>Choose favorite team</option>
											<?php
												$consultaEquipo = $connectdb->query("SELECT team_id, team_name FROM equipos ORDER BY team_name");
												while($resultadoEquipo = $consultaEquipo->fetch_object()) {
													echo '<option value="' .$resultadoEquipo->team_id. '">' .$resultadoEquipo->team_name.'</option>';
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-6">
									<button type="submit" class="btn btn-outline-success mx-auto">Change team</button>
								</div>
							</div>
						</form><!--Fin del formulario para cambiar el equipo favorito-->
					</div><!--Fin del colapsable para cambiar el equipo favorito-->
					
				</div><!--Fin de la columna general izquierda-->
				<!--Div para el mapa-->
				<div class="col-12 col-md-6">
					<div class="mapInfo">
						<?php
							$comprobacionPais = $connectdb->query("SELECT usuarios.*, paises.* FROM usuarios, paises WHERE usuarios.id_pais = paises.id_pais AND usuario = '$usuario'");
							$filaPais = $comprobacionPais->fetch_object();
						?>
						<input type="text" value="<?= $filaPais->latitudCapital ?>" id="latitud" hidden></input>
						<input type="text" value="<?= $filaPais->longitudCapital ?>" id="longitud" hidden></input>
						<div id="userMap"></div>
						<p class="text-center text-muted my-2">Capital of the country of origin</p>
					</div>
				</div>
			</div>
			
		
		
		</div> <!-- Fin del container -->
		
		
		<script>
			//Creación del mapa, con las coordenadas que se le pasan de la base de datos y se almacenan en los inputs.
			function initMap() {
				var latitud = parseFloat(document.getElementById("latitud").value);
				var longitud = parseFloat(document.getElementById("longitud").value);
        		var mapita = {lat: latitud, lng: longitud};
        		var map = new google.maps.Map(document.getElementById('userMap'), {
          			zoom: 7,
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
		<div id="dialog-confirm" title="¿Eliminar el usuario seleccionado?">
  			<p><span class="ui-icon ui-icon-alert"></span>Este usuario será eliminado. 
			  ¿Estás seguro de querer hacer esto?</p>
		</div>
		<?php include("scripts.php"); ?>
		<!-- Archivo local de scripts -->
		<script src="../js/perfil.js"></script>
    </body>
</html>
