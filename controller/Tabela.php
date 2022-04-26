<?php
class Tabela
{
  private $message = "";
  public function __construct(){
    Transaction::open();
  }

  public function controller()
  {
    Transaction::get();
    $cardapio = new Crud("cardapio");
    $resultado = $cardapio->select();
    $tabela = new Template("view/tabela.html");
    $tabela->set("linha", $resultado);
    $this->message = $tabela->saida();
  }

  public function remover(){
    try {
      $conexao = Transaction::get();
      $id = $conexao->quote($_GET["id"]);
      $cardapio = new Crud("cardapio");
      $resultado = $cardapio->delete("id = $id");
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function getMessage()
  {
    return $this->message;
  }

  public function __destruct(){
    Transaction::close();
  }
}
