<?php 

Class Usuario{
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario(){
		return $this -> idusuario;
	}

	public function setIdusuario($value){
		$this -> idusuario = $value;
	}

	public function getDeslogin(){
		return $this -> deslogin;
	}

	public function setDesloin($value){
		$this -> deslogin = $value;
	}

	public function getDessenha(){
		return $this -> dessenha;
	}

	public function setDessenha($value){
		$this -> dessenha = $value;
	}

	public function getDtcadastro(){
		return $this -> dtcadastro;
	}
	public function setDtcadastro($value){
		$this -> dtcadastro = $value;
	}

	public function loadById($id){
		$sql = new Sql();

		//select definida na classe Sql.
		$results = $sql -> select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id));

		//Verificando se SELECT retornou algo. Lembrando que o retorno é um Array.
		if(isset($results[0])){
			//poderia verificar assim:
			//if(count($results)>0)

			$row = $results[0];
		//As chaves do array são os nomes dos campos do banco retornados da consulta. Ver o retorno do index.php para melhor entendimento.

			$this -> setIdusuario($row['idusuario']);
			$this -> setDesloin($row['deslogin']);
			$this -> setDessenha($row['dessenha']);
			$this -> setDtcadastro(new DateTime($row['dtcadastro']));
			//DateTime retorna no formato dd-MM-yy, no banco yy-MM-dd
		}
	}
	public function __toString(){
		return json_encode(array(
			"ID:" => $this -> getIdusuario(),
			"Login:" => $this -> getDeslogin(),
			"Senha:" => $this -> getDessenha(),
			"Data do Cadastro:" => $this -> getDtcadastro()->format("d/m/Y H:i:s")
		));
	}

/***********************************************************************
  __toString: Exemplo, Exemplo05-SerializacaoDeObjetos.php da pasta Classes.
  - Método para serialização de objeto, transformando em string.
  - Permite darmos um echo diretamente no objeto, sem a necessidade de gets.
  - Ao chamarmos o objeto direatmente com echo, mesmo não tendo métodos para leitura, cairemos nesse (como se fosse um padrão).
*************************************************************************/
}

 ?>
