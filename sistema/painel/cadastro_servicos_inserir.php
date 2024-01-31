<?php
include "config.php"; // Certifique-se de incluir seu arquivo de conexão ao banco de dados

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Inicializa um array para armazenar a resposta
    $response = array();

    // Recupera os dados do formulário (certifique-se de validar e filtrar os dados adequadamente)
    $nome = $_POST["nome"];
    $valor = $_POST["valor"];
    $categoria = $_POST["categoria"];
    $dias_retorno = $_POST["dias_retorno"];
    $comissao = $_POST["comissao"];
    $tempo_extimado = $_POST["tempo_extimado"];
    $servicoId = $_POST["servicoId"];

    $method = 'Insert';

    if (empty($servicoId)) {
        // Se servicoId está vazio, é uma inserção
        $sql = "INSERT INTO servicos (nome, valor, categoria, dias_retorno, comissao, tempo_extimado) VALUES (?, ?, ?, ?, ?, ?)";

        // Adiciona a mensagem ao array de resposta
        $response['message'] = 'Servico inserido com sucesso!';
    } else {
        $method = 'Update';
        // Se servicoId não está vazio, é uma atualização
        $sql = "UPDATE servicos SET nome = ?, valor = ?, categoria = ?, dias_retorno = ?, comissao = ?, tempo_extimado = ? WHERE id = ?";

        // Adiciona a mensagem ao array de resposta
        $response['message'] = 'Servico atualizado com sucesso!';
    }

    // Verifica se a conexão com o banco de dados foi estabelecida com sucesso
    if ($conexao) {
        // Prepara a declaração SQL
        $stmt = $conexao->prepare($sql);

        // Verifica se a preparação foi bem-sucedida
        if ($stmt) {
            // Faz o binding dos parâmetros
            if ($method == 'Insert') {
                $stmt->bind_param("ssssss", $nome, $valor, $categoria, $dias_retorno, $comissao, $tempo_extimado);
            } else {
                $stmt->bind_param("ssssssi", $nome, $valor, $categoria, $dias_retorno, $comissao, $tempo_extimado, $servicoId);
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
