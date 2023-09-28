<?php
include_once "../conexao/Conexao.php";
include_once "../model/Usuario.php";
include_once "../dao/UsuarioDAO.php";

//instanciar as classes
$usuario = new Usuario();
$usuariodao = new UsuarioDAO();

//passar os posts - dados

$d = filter_input_array(INPUT_POST);

//Se for gravado com sucesso
if(isset($_POST['cadastrar'])){

    $usuario->setNome($d['nome']);
    $usuario->setSobrenome($d['sobrenome']);
    $usuario->setIdade($d['idade']);
    $usuario->setSexo($d['sexo']);

    $usuariodao->create($usuario);

    header("Location: ../../");
}

//Se a requisição for Editar
else if(isset($_POST('editar'))){

    $usuario->setNome($d['nome']);
    $usuario->setSobrenome($d['sobrenome']);
    $usuario->setIdade($d['idade']);
    $usuario->setSexo($d['sexo']);

    $usuariodao->update($usuario);

    header("Location: ../../");

}

//Se a requisição for Deletar
else if(isset($_GET['del'])){

    $usuario->setId($_GET['del']);
    $usuariodao->delete($usuario);

    header("Location: ../../");
}else{
    header("Location: ../../");
}
