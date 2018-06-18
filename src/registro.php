<?php

    require_once("databaseconnection.php");
    require_once("operacionesregistro.php");

    if(isset($_GET["mensajeError"])){
        $mensaje = "<div class=\"alert alert-warning alert-dismissible fade show text-center\" role=\"alert\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
          <span aria-hidden=\"true\">&times;</span>
        </button>
        <strong>ERROR</strong> Username already taken. Try another!
      </div>" ;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sign up - Wikibasket</title>
		<?php include("header.php"); ?>
		<!-- Archivo local de estilos CSS -->
		<link rel="stylesheet" href="../css/registro.css">
    </head>
    <body>
    <div class="container">
        <div class="row">
        <div class="card border-warning text-center mx-auto my-5">
				<div class="card-header brand">
                 Wikibasket
				</div>
				<div class="card-body">
					<h4 class="card-title text-center">Sign up</h4>
					<form method="post" >
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="input-group mt-2">
                                    <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    <input type="text" name="usuario" id="usuario" class="form-control px-1" placeholder="Username" maxlength="20">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="input-group mt-2">
                                    <span class="input-group-text"><i class="fa fa-at" aria-hidden="true"></i></span>
                                    <input type="email" name="email" id="email" class="form-control px-1" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="input-group mt-2">
                                    <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    <input type="password" name="contrasena" id="contrasena" class="form-control px-1" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="input-group mt-2">
                                    <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    <input type="password" name="confirmarContrasena" id="confirmarContrasena" class="form-control px-1" placeholder="Repeat password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="input-group mt-2">
                                    <span class="input-group-text"><i class="fab fa-amilia" aria-hidden="true"></i></span>
                                    <input type="text" name="nombre_completo" id="nombre_completo" class="form-control px-1" placeholder="Full name">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="input-group mt-2">
                                    <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                    <input type="text" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control px-1" placeholder="Birth date">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="input-group mt-2">
                                    <span class="input-group-text"><i class="fa fa-globe" aria-hidden="true"></i></span>
                                    <select name="pais_origen" class="custom-select px-1">Country of origin:
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
                            <div class="col-12 col-md-6">
                                <div class="input-group mt-2">
                                    <span class="input-group-text"><i class="fa fa-basketball-ball" aria-hidden="true"></i></span>
                                    <select name="equipo_favorito" class="custom-select px-1">
                                        <option value="" disabled selected>Choose favorite team</option>
                                        <?php
                                            $consultaEquipo = $connectdb->query("SELECT * FROM equipos ORDER BY team_name");
                                            while($resultadoEquipo = $consultaEquipo->fetch_object()) {
                                                echo '<option value="' .$resultadoEquipo->team_id. '">' .$resultadoEquipo->team_name.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
						<button type="submit" class="btn btn-outline-success">Sign up</button>
					</form>
					<div class="card-footer text-muted">
                        <p><a href="login.php" class="link">Already have an account? Log in</a></p>
                        <?= isset($mensaje) ? $mensaje : "" ; ?>
  					</div>
				</div>
			</div>
        </div>
			
		
		</div>
        <?php include("scripts.php"); ?>
		<!-- Archivo local de scripts -->
		<script src="../js/registro.js"></script>
    </body>
</html>
