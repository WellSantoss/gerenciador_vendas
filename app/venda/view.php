<?php
  require_once("./app/conexao.php");

  try {
    $id_usuario = $_SESSION['id'];
    $sql = "SELECT vendas.id, clientes.nome_cliente,  produtos.nome_produto, data_venda, quantidade, status_pgto, data_pgto FROM vendas
      JOIN clientes
      ON vendas.id_cliente = clientes.id
      JOIN produtos
      ON vendas.id_produto = produtos.id
      WHERE vendas.id_usuario = $id_usuario";

    $select = $conexao -> query($sql);
    $result = $select -> fetchAll();
  }
  catch (PDOException $e) {
    echo "Erro: " . $e->getCode() . "<br> Mensagem: " . $e->getMessage();
  }

  function status ($status) {
    if ($status == 0) {
      return "A pagar";
    }
    else {
      return "Pago";
    }
  }