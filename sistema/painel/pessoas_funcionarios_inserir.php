<?php
include "config.php"; // Certifique-se de incluir seu arquivo de conexão ao banco de dados

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Inicializa um array para armazenar a resposta
    $response = array();

    // Recupera os dados do formulário (certifique-se de validar e filtrar os dados adequadamente)
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $cpf = $_POST["cpf"];
    $cargo = $_POST["cargo"];
    $atendimento = $_POST["atendimento"];
    $tipo_chave_pix = $_POST["tipo_chave_pix"];
    $chave_pix = $_POST["chave_pix"];
    $endereco = $_POST["endereco"];
    $intervalo_min = $_POST["intervalo_min"];
    $comissao = $_POST["comissao"];
    $funcionarioId = $_POST["funcionarioId"];

    $method = 'Insert';

    if (empty($funcionarioId)) {
        // Se funcionarioId está vazio, é uma inserção
        $sql = "INSERT INTO funcionarios (nome, email, telefone, cpf, cargo, atendimento, tipo_chave_pix, chave_pix, endereco, intervalo_min, comissao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Adiciona a mensagem ao array de resposta
        $response['message'] = 'Funcionário inserido com sucesso!';
    } else {
        $method = 'Update';
        // Se funcionarioId não está vazio, é uma atualização
        $sql = "UPDATE funcionarios SET nome = ?, email = ?, telefone = ?, cpf = ?, cargo = ?, atendimento = ?, tipo_chave_pix = ?, chave_pix = ?, endereco = ?, intervalo_min = ?, comissao = ? WHERE id = ?";

        // Adiciona a mensagem ao array de resposta
        $response['message'] = 'Funcionário atualizado com sucesso!';
    }

    // Verifica se a conexão com o banco de dados foi estabelecida com sucesso
    if ($conexao) {
        // Prepara a declaração SQL
        $stmt = $conexao->prepare($sql);

        // Verifica se a preparação foi bem-sucedida
        if ($stmt) {
            // Faz o binding dos parâmetros
            if ($method == 'Insert') {
                $stmt->bind_param("sssssssssss", $nome, $email, $telefone, $cpf, $cargo, $atendimento, $tipo_chave_pix, $chave_pix, $endereco, $intervalo_min, $comissao);
            } else {
                $stmt->bind_param("sssssssssssi", $nome, $email, $telefone, $cpf, $cargo, $atendimento, $tipo_chave_pix, $chave_pix, $endereco, $intervalo_min, $comissao, $funcionarioId);
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
