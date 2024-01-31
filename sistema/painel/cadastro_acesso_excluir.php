<?php
include "config.php";

$response = array(); // Inicializa um array para a resposta

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $idAcesso = $_GET["id"];

    $sql = "UPDATE acesso SET ativo = 0 WHERE id = ?";
    $stmt = $conexao->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $idAcesso);

        if ($stmt->execute()) {
            // Exclusão bem-sucedida
            $response["success"] = true;
            $response["message"] = "Acesso excluído com sucesso!";
        } else {
            // Erro ao executar a declaração preparada
            $response["success"] = false;
            $response["message"] = "Erro ao excluir o Acesso: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Erro na preparação da consulta
        $response["success"] = false;
        $response["message"] = "Erro na preparação da consulta: " . $conexao->error;
    }

    // Envie a resposta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>