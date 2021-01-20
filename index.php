<?php 

require_once("config.php");

//sql() referencia o arquivo (classe) sql.php. Encontrada automaticamente através do autoload em config.php.

$sql = new sql();

// select é uma função da classe sql.php
$usuarios = $sql -> select ("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);
?>