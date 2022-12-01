<?php

    try {

        $host = "localhost";
        $dbase = "vallepolpa_vp";
        $root = "vallepolpa";
        $pass = "&s?OEyZU{cZY";

        $PDO = new PDO("mysql:host=".$host. ";dbname=".$dbase. ";charset=utf8", $root, $pass);

    } catch (PDOException $erro) {
        echo "Erro Conexão, ".$erro->getMessade();
    }
?>