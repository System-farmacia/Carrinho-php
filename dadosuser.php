<?php
session_start();
  
if (!isset($_SESSION["usuario_id"]))
    {
        //em outrtas palavras, se o id do usuario não estiver definido na sessão, redireciona para a página de login ou outra página apropriada
        header("Location: inicio.php"); // Redireciona para a página de login ou outra página se o id do usuario não estiver definido
        
        exit();
    }
      include "db.php"; // Inclui o arquivo de conexão com o banco de dados
    
$dadosconsulta=$db->prepare("SELECT * FROM usuarios WHERE usuario_id = ?"); // Prepara a consulta SQL para selecionar os dados do usuário com base no ID armazenado na sessão
$dadosconsulta->bind_param("i", $_SESSION["usuario_id"]); // começa com i pq é inteiro. Vincula o parâmetro da consulta com o ID do usuário armazenado na sessão
$dadosconsulta->execute(); // Executa a consulta SQL
$resultado = $dadosconsulta->get_result(); // Obtém o resultado da consulta
$user_data=$resultado->fetch_assoc();

if (!$user_data) {
    // Se os dados do usuário não forem encontrados, redireciona para a página de login ou outra página apropriada
    header("Location: home.php"); // Redireciona para a página de login ou outra página se os dados do usuário não forem encontrados
    
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
include 'userview.php';
exibirDadosUsuario($user_data);

?>
</body>
</html>
