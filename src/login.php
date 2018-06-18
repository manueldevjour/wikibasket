<?php
	require_once("databaseconnection.php");
	require_once("operacioneslogin.php");

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Log in - Wikibasket</title>
		<?php include("header.php"); ?>
		<!-- Archivo local de estilos CSS -->
		<link rel="stylesheet" href="../css/login.css">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="card w-50 border-warning text-center mx-auto my-5">
					<div class="card-header brand">
						Wikibasket
					</div>
					<div class="card-body">
						<h4 class="nombre card-title text-center">Log in</h4>
						<form method="post">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-text"><i class="fa fa-user fa-fw" aria-hidden="true"></i></span>	
									<input type="text" name="usuario" class="form-control" placeholder="Username" maxlength="20" required>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-text"><i class="fa fa-lock fa-fw" aria-hidden="true"></i></span>	
									<input type="password" name="contrasena" class="form-control" placeholder="Password" required>	
								</div>
							</div>
							<button type="submit" class="btn btn-outline-primary">Log in</button>
							<?= isset($mensaje) ? $mensaje : "" ; ?>
						</form>
						<div class="card-footer text-muted">
							<p><a href="registro.php" class="link">Do not have an account yet?</a></p>
						</div>
					</div>
				</div>
			</div>
			
		
		</div>
		
		<?php include("scripts.php"); ?>
		<!-- Archivo local de scripts -->
		<script src="../js/login.js"></script>
	</body>
</html>