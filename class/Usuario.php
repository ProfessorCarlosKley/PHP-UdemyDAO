getDtcadastro<?php 

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

	public function __construct($login = "", $password = ""){
		//Se a classe for iniciada sem parâmetros preenche com vazio.
		$this -> setDeslogin($login);
		$this -> setDessenha($password);
	}

	public static function getlist(){
	//método estático pode ser usado sem instanciar
		/*É importante que os métodos estáticos não fiquem amarrados na classe.
		Por exemplo, usar $this para setar um atributo da classe ou get e set.
		- Como boas práticas, é bom que estáticos sejam livres de amarrações.
		*/
		$sql = new Sql();
		return $sql -> select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
	}

	public static function search($login){
		$sql = new Sql();
		return $sql -> select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(':SEARCH'=> "%".$login."%"));
	}

	public function loadById($id){//Carregar pelo ID.
		$sql = new Sql();

		//select definida na classe Sql.
		$results = $sql -> select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id));

		//Verificando se SELECT retornou algo. Lembrando que o retorno é um Array.
		if(isset($results[0])){
			//poderia verificar assim:
			//if(count($results)>0)

		$this -> setData($results[0]);
			
		}
	}

	public function login($login, $password){//Autenticando Login

		$sql = new Sql();

		$results = $sql -> select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(":LOGIN"=>$login,
		":PASSWORD" => $password
	));

		//Verificando se SELECT retornou algo. Lembrando que o retorno é um Array.
		if(isset($results[0])){
			//poderia verificar assim:
			//if(count($results)>0)

		$this -> setData($results[0]);
			
		} else {
			throw new Exception("Login e/ou senha inválido.");
		}

		}

	public function setData($data){

			$this -> setIdusuario($data['idusuario']);
			$this -> setDeslogin($data['deslogin']);
			$this -> setDessenha($data['dessenha']);
			$this -> setDtcadastro(new DateTime($data['dtcadastro']));
		}

	public function insert(){
		$sql = new Sql();
		//Buscando ID para 
		$results = $sql -> select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)",
				//CALL para criar procedures no MySQL.
				//sp_usuarios_insert foi criado no banco de dados, através do MySql WorkBench, não vi no phpAdmin a opção, a não ser por código.

			array(':LOGIN' => $this -> getDeslogin(), 
				  ':PASSWORD' => $this -> getDessenha()
			));
			if (count($results)>0){
				$this -> setData($results[0]);
			}
		}

	public function update($login, $password){
		$this -> setDeslogin($login);
		$this -> setDessenha($password);

		$sql = new Sql();

		$sql -> query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID",
			array(':LOGIN' => $this -> getDeslogin(),
				  ':PASSWORD' => $this -> getDessenha(),
				  ':ID' => $this -> getIdusuario()
			));
	}

	public function __toString(){
		return json_encode(array(
			"ID:" => $this -> getIdusuario(),
			"Login:" => $this -> getDeslogin(),
			"Senha:" => $this -> getDessenha(),
			"Data do Cadastro:" => $this -> getDtcadastro() -> format("d/m/Y H:i:s")
		));
			}

/***********************************************************************
  __toString: Exemplo, Exemplo05-SerializacaoDeObjetos.php da pasta Classes.
  - Método para serialização de objeto, transformando em string.
  - Permite darmos um echo diretamente no objeto, sem a necessidade de gets.
  - Ao chamarmos o objeto direatmente com echo, mesmo não tendo métodos para leitura, cairemos nesse (como se fosse um padrão).
*************************************************************************/
	} //FIM DA CLASSE

 ?>
 