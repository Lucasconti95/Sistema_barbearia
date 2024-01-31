<?php
require_once("conexao.php");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nome_sistema ?></title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="css/estilo-login.css" type="text/css" rel="stylesheet">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" href="img/barber-shop.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="row vertical-offset-100">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default formlogin">
                    <div class="panel-heading" align="center">
                        <img src="img/logo4.jpg" width="250px">
                    </div>
                    <div class="panel-body">
                        <form accept-charset="UTF-8" role="form" action="autenticar.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail ou CPF" name="email" type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senhas" name="senha" type="password" value="">
                                </div>
                                <input class="btn btn-lg btn-primary btn-block" type="submit" value="Entrar">
                            </fieldset>
                            <p class="recuperar"><a title='Clique para recuperar a senha' href="" data-toggle="modal" data-target="#exampleModal">Recuperar Senha</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:400px">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Recuperar Senha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">

                    <input placeholder="digite seu email" class="form-control" type="email" name="email" required>

                    <div id="msg-recuperar"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Recuperar</button>
                </div>
            </form>
        </div>
    </div>
</div>