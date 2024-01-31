<?php
include "config.php"; // Certifique-se de incluir seu arquivo de conexão ao banco de dados

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Inicializa um array para armazenar a resposta
    $response = array();

    // Recupera os dados do formulário (certifique-se de validar e filtrar os dados adequadamente) nome, telefone, tipo_chave_pix, chave_pix, endereco
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $tipo_chave_pix = $_POST["tipo_chave_pix"];
    $chave_pix = $_POST["chave_pix"];
    $endereco = $_POST["endereco"];
    $fornecedorId = $_POST["fornecedorId"];

    $method = 'Insert';

    if (empty($fornecedorId)) {
        // Se usuarioId está vazio, é uma inserção
        $sql = "INSERT INTO fornecedores (nome, telefone, tipo_chave_pix, chave_pix, endereco) VALUES (?, ?, ?, ?, ?)";

        // Adiciona a mensagem ao array de resposta
        $response['message'] = 'Dados inseridos com sucesso!';
    } else {
        $method = 'Update';
        // Se usuarioId não está vazio, é uma atualização
        $sql = "UPDATE fornecedores SET nome = ?, telefone = ?, tipo_chave_pix = ?, chave_pix = ?, endereco = ? WHERE id = ?";

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
                $stmt->bind_param("sssss", $nome, $telefone, $tipo_chave_pix, $chave_pix, $endereco);
            } else {
                $stmt->bind_param("sssssi", $nome, $telefone, $tipo_chave_pix, $chave_pix, $endereco, $fornecedorId);
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
