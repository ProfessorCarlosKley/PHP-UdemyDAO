<?php 

require_once("config.php");

//sql() referencia o arquivo (classe) sql.php. Encontrada automaticamente através do autoload em config.php.

echo "EFETUANDO CONSULTA COM A CLASSE Sql.php <br><br>";
$sql = new Sql();
// select é uma função da classe sql.php
$usuarios = $sql -> select ("SELECT * FROM tb_usuarios");
echo json_encode($usuarios);

echo "<br><br> USANDO A CLASS Usuario.php <br><br>";

$root = new Usuario();
$root -> loadById(1); 
echo $root;
?>