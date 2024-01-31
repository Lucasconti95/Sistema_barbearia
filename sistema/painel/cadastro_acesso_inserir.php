<?php
include "config.php"; // Certifique-se de incluir seu arquivo de conexão ao banco de dados

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Inicializa um array para armazenar a resposta
    $response = array();

    // Recupera os dados do formulário (certifique-se de validar e filtrar os dados adequadamente)
    $nome = $_POST["nome"];
    $chave = $_POST["chave"];
    $grupo = $_POST["grupo"];
    $acessoId = $_POST["acessoId"];

    $method = 'Insert';

    if (empty($acessoId)) {
        // Se acessoId está vazio, é uma inserção
        $sql = "INSERT INTO acesso (nome, chave, grupo) VALUES (?, ?, ?)";

        // Adiciona a mensagem ao array de resposta
        $response['message'] = 'Acesso inserido com sucesso!';
    } else {
        $method = 'Update';
        // Se acessoId não está vazio, é uma atualização
        $sql = "UPDATE acesso SET nome = ?, chave = ?, grupo = ? WHERE id = ?";

        // Adiciona a mensagem ao array de resposta
        $response['message'] = 'Acesso atualizado com sucesso!';
    }

    // Verifica se a conexão com o banco de dados foi estabelecida com sucesso
    if ($conexao) {
        // Prepara a declaração SQL
        $stmt = $conexao->prepare($sql);

        // Verifica se a preparação foi bem-sucedida
        if ($stmt) {
            // Faz o binding dos parâmetros
            if ($method == 'Insert') {
                $stmt->bind_param("sss", $nome, $chave, $grupo);
            } else {
                $stmt->bind_param("sssi", $nome, $chave, $grupo, $acessoId);
            }

            // Executa a declaração preparada
            $response['success'] = $stmt->execute();

            // Fecha a declaração preparada
            $stmt->close();
        } else {
            // Erro na preparação da consulta
            $response['success'] = false;
            $response['message'] = 'Erro na preparação da consulta: ' . $conexao->error;
        }

        // Fecha a conexão com o banco de dados
        $conexao->close();
    } else {
        // Erro na conexão com o banco de dados
        $response['success'] = false;
        $response['message'] = 'Erro na conexão com o banco de dados';
    }

    // Retorna a resposta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
