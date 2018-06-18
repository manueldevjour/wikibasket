<?php

    $connectdb = @new mysqli("localhost", "root", "", "tbasketball");
    if($connectdb->connect_errno) {
        echo "Lo sentimos, no se ha podido establecer la conexión con la base de datos.<br>
        Por favor, póngase en contacto con el <a href='https://www.github.com/manueldevjour' target='_blank'>administrador</a> de la página<br><br>";
        die("**Error $connectdb->connect_errno: $connectdb->connect_error.<br>");
    } else {
        $connectdb->set_charset("utf8");
        return $connectdb;
    }


?>