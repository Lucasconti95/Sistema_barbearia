<?php
    @session_start();
    require_once("conexao.php");

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $query = $pdo->query("SELECT * FROM usuarios where email = '$email' and senha = '$senha' ");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);

    if($total_reg > 0){

        
        $ativo = $res[0]['ativo'];

        if($ativo == '1'){

            $_SESSION ['id'] = $res[0]['id'];
            $_SESSION ['nivel'] = $res[0]['nivel'];
            $_SESSION ['nome'] = $res[0]['nome'];

            //ir para o painel
            echo "<script>window.location='painel'</script>";
            
        }else{
            echo "<script>window.alert('Seu usuário foi desativado, contate o administrador!')</script>";
        }

    }else{
        echo "<script>window.alert('Usuário ou Senha Incorretos!')</script>";
        echo "<script>window.location='index.php'</script>";
    }
?>