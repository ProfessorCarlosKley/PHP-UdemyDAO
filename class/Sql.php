<?php 
//USANDO PDO COM DAO (Data Object Access)
//Classes para conversar com BAnco
class Sql extends PDO{
	//Herda de PDO.
	private $conn;

	public function __construct(){
	
	$this -> conn = new PDO("mysql:host=localhost;dbname=udemydbphp7", "root", "");
}

	//Prepara um parâmetro apenas recebido pelo foreach da função abaixo.
	private function setParam($statement, $key, $value){
		$statement->bindParam($key, $value);
	}


	private function setParams($statement, $parameters = array()){
		foreach ($parameters as $key => $value) {
		$this -> setParam($statement, $key, $value);
		//Chama setParam ao receber um array, e prepara o bind.
		//Para cada linha do array, chama setParam com a chave e o valor específico. E, por sua vez, setParam Cria os binds para cada parâmetro.
		}
	}

	public function query($rowQuery, $params = array()){
	//rowqurey é o comando sql (DELETE, SELECT, INSERT...)
	//Passagem por array no exemplo 06 e 07 da pasta PDO.
	$stmt = $this -> conn -> prepare($rowQuery);
	//conn não precisa ser indicada com $. É um atributo da classe
	//Ver nas aulas de objetos.
  	$this -> setParams($stmt, $params);
	
	$stmt -> execute();

	return $stmt;

	}

	public function select($rawQuery, $params = array()):array{
		$stmt = $this -> query($rawQuery, $params);
		return $stmt -> fetchAll(PDO::FETCH_ASSOC);
		//fatchAll Exemplo01 da pasta PDO.
	}
}

?>