<?php 

require_once("config.php");

/*$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);
*/


//carrega o usuário
/*
$root = new Usuario();

$root->loadById(2);

echo $root . "<br><br>";
*/

//Carrega uma lista de usuários

$lista = Usuario::getList();
echo json_encode($lista);

//
echo "<br><br>";

//Carrega uma lista de usuário procurando pelo login

$Procurado = Usuario::search("jos");
echo json_encode($Procurado);

//

echo "<br><br>";
//

//carrega o usuario usando o login e a senha
$Logado = Usuario::login("jose", "123243423434");
echo json_encode($Logado);

//
echo "<br><br>";
//

//inserir uma pessoa
/*$aluno = new Usuario("aluno", "29ultimate");
$aluno->insert();
echo $aluno;
*/

//atualizar uma pessoa pelo id
/*
$usuario = new Usuario();

$usuario->loadById("10");
$usuario->update("aluneira");
echo $usuario;
*/
?>