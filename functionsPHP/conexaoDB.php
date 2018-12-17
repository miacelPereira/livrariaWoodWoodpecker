<?php
    function conexaoBD(){
        $host = "192.168.0.2";
        //$host = "localhost";
        $database = "dbpc1020182";
        $user = "pc1020182";
        $password = "senai127";

        if(!$conexao = mysqli_connect($host, $user, $password, $database)){
            echo("ERRO! Não foi possível fazer a conexão com o banco de dados");
        }

    return $conexao;

    }
?>
