<?php
$conectar = mysqli_connect("localhost", "pratoc06", "DgT9x6ey17", "pratoc06_vallepolpas") or die (mysqli_error());


if(mysqli_connect_errno()){
    echo "falha ao conectar: ". mysqli_connect_error();
    die();
}

?>
