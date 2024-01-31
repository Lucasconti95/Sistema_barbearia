<?php
include "config.php"; // Certifique-se de incluir seu arquivo de conexão ao banco de dados

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Inicializa um array para armazenar a resposta
    $response = array();

    // Recupera os dados do formulário (certifique-se de validar e filtrar os dados adequadamente)
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $cpf = $_POST["cpf"];
    $cartoes = $_POST["cartoes"];
    $endereco = $_POST["endereco"];
    $nascimento = $_POST["nascimento"];
    $clienteId = $_POST["clienteId"];

    $method = 'Insert';

    if (empty($clienteId)) {
        // Se clienteId está vazio, é uma inserção
        $sql = "INSERT INTO clientes (nome, telefone, cpf, cartoes, endereco, nascimento) VALUES (?, ?, ?, ?, ?, ?)";

        // Adiciona a mensagem ao array de resposta
        $response['message'] = 'Dados inseridos com sucesso!';
    } else {
        $method = 'Update';
        // Se clienteId não está vazio, é uma atualização
        $sql = "UPDATE clientes SET nome = ?, telefone = ?, cpf = ?, cartoes = ?, endereco = ?, nascimento = ? WHERE id = ?";

        // Adiciona a mensagem ao array de resposta
        $response['message'] = 'Dados atualizados com sucesso!';
    }

    // Verifica se a conexão com o banco de dados foi estabelecida com sucesso
    if ($conexao) {
        // Prepara a declaração SQL
        $stmt = $conexao->prepare($sql);

        // Verifica se a preparação foi bem-sucedida
        if ($stmt) {
            // Faz o binding dos parâmetros

            if ($method == 'Insert') {
                $stmt->bind_param("ssssss", $nome, $telefone, $cpf, $cartoes, $endereco, $nascimento);
            } else {
                $stmt->bind_param("ssssssi", $nome, $telefone, $cpf, $cartoes, $endereco, $nascimento, $clienteId);
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
