<?php 

class Usuario {
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario(){
		return $this->idusuario;
	}
	public function setIdusuario($def_idusuario){
		$this->idusuario = $def_idusuario;
	}


	public function getDeslogin(){
		return $this->deslogin;
	}
	public function setDeslogin($def_deslogin){
		$this->deslogin = $def_deslogin;
	}


	public function getDessenha(){
		return $this->dessenha;
	}
	public function setDessenha($def_dessenha){
		$this->dessenha = $def_dessenha;
	}


	public function getDtcadastro(){
		return $this->dtcadastro;
	}
	public function setDtcadastro($def_dtcadastro){
		$this->dtcadastro = $def_dtcadastro;
	}

	public function loadById($id){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID;", array(":ID"=>$id));

		if (isset($results[0])){
			$row = $results[0];

			$this->setData($row);

		} 
	}

	public static function getList(){
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
	}

	public static function search($login){
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER by deslogin;", array(':SEARCH'=>"%".$login."%"));
	}

	public static function login($login, $password){
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA;", array(':LOGIN'=>$login, ':SENHA'=>$password));
	}

	public function setData($data){

		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));

	}

	public function insert(){

		$sql = new Sql();

		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(":LOGIN"=>$this->getDeslogin(),"PASSWORD"=>$this->getDessenha()));

		if (isset($results[0])){
			$row = $results[0];

			$this->setData($row);

		} 
	}

	public function update($login = "", $dessenha = ""){

		if ($login != ""){
			$this->setDeslogin($login);
		} else {
			$login = $this->getDeslogin();
		}

		if ($dessenha != ""){
			$this->setDessenha($dessenha);
		} else {
			$dessenha = $this->getDessenha();
		}

		$sql = new Sql();

		$sql->execQuery("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario =:ID", array(
			':LOGIN'=>$login,
			':PASSWORD'=>$dessenha,
			':ID'=>$this->getIdusuario()
		));


	}

	public function __construct($login = "", $passaword = ""){
		$this->setDeslogin("aluno");
		$this->setDessenha("29Ultimate");
	}

	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}
}

?>