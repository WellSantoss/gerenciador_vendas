<?php
  // $id_usuario = $this->session->userdata('id_usuario');
  $usuario = filter_input(INPUT_POST, "id_usuario", FILTER_SANITIZE_NUMBER_INT);
  $nome    = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
  $valor   = filter_input(INPUT_POST, "valor", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

  require_once("../conexao.php");

  try {
    $comandoSQL = $conexao -> prepare("INSERT INTO produtos (id_usuario, nome, valor) VALUES (:usuario, :nome, :valor)");

    $comandoSQL -> execute(array(
      ':usuario' => $usuario,
      ':nome'    => $nome,
      ':valor'   => $valor
    ));

    if ($comandoSQL -> rowCount() > 0) {
      header('Location:../../produtos.php');
    } else {
      echo "ERRO.";
    }

  } catch (PDOException $e) {
    echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage(); 
  }

  $conexao = null; // Fecha a conexão