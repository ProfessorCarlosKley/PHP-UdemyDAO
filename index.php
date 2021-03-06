<?php 

require_once("config.php");

//sql() referencia o arquivo (classe) sql.php. Encontrada automaticamente através do autoload em config.php.

echo "EFETUANDO CONSULTA COM A CLASSE Sql.php <br><br>";
$sql = new Sql();
// select é uma função da classe sql.php
$usuarios = $sql -> select ("SELECT * FROM tb_usuarios");
echo json_encode($usuarios);

echo "<br><br> USANDO A CLASS Usuario.php - CONSULTANDO ID<br><br>";
$root = new Usuario();
$root -> loadById(1); 
echo $root;

echo "<br><br> USANDO A CLASS Usuario.php - ESTÁTICA<br><br>";
$lista = Usuario::getlist();
//:: acessa método estático. Não precisa ser instanciado.Chamamos de forma direta.
echo json_encode($lista);

echo "<br><br> USANDO O MÉTODO search de Usuario.php - ESTÁTICA<br><br>";
//Carrega uma lista pelo login.
$busca = Usuario::search("car");
echo json_encode($busca);

echo "<br><br> USANDO O MÉTODO login de Usuario.php<br><br>";
$usr = new Usuario();
$usr -> login("root", "58958900");
echo $usr;

echo "<br><br> NOVO USUÁRIO COM A CLASSE insert de Usuario.php<br><br>";

/*MÉTODO INSERIR, Comentado para nã encher o banco ***********************
$inserir = new Usuario("php7", "%$!@#");
//$inserir -> setDeslogin("php");
//$inserir -> setDessenha("7000");
//set's agora alimentados pelo constructor

$inserir -> insert();
//Após inserir chama o último ID e lista. Conform linha 124 da classe usuario.php
//$this -> setData($results[0]);
//setData um método para listagem do array retornado. Retorno [0] sem laço pois só temos um retorno de registro.
echo $inserir;
****************************************************************************/
echo "<br><br> ATUALIZANDO USUÁRIO COM A CLASSE update de Usuario.php<br><br>";

$atualizar = new Usuario();

$atualizar -> loadById(1);

$atualizar -> update("root", "root589589");

echo $atualizar;

?>