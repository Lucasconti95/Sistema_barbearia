<?php
    $banco = 'barbearia';
    $usuario = 'root';
    $senha = '';
    $servidor = 'Localhost';
    date_default_timezone_set('America/Sao_Paulo');
    try {
        $pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", $usuario, $senha);
      } catch(Exception $e) {
          echo 'Não conectado ao banco de dados! <br><br>' .$e;
      }
      //VARIAVEIS DE AMBIENTE
      $nome_sistema = 'barbearia';
      $email_sistema = 'lucas.902@gmail.com';
?>