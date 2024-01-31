<?php
include "config.php";

$response = array(); // Inicializa um array para a resposta

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $idGrupo = $_GET["id"];

    $sql = "UPDATE grupo SET ativo = 0 WHERE id = ?";
    $stmt = $conexao->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $idGrupo);

        if ($stmt->execute()) {
            // Exclusão bem-sucedida
            $response["success"] = true;
            $response["message"] = "Grupo excluído com sucesso!";
        } else {
            // Erro ao executar a declaração preparada
            $response["success"] = false;
            $response["message"] = "Erro ao excluir o Grupo: " . $stmt->error;
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