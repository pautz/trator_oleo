<?php
include 'db.php'; // Conexão com o banco de dados

header('Content-Type: application/json; charset=utf-8');

try {
    // Captura os dados enviados pelo frontend
    $data = json_decode(file_get_contents("php://input"), true);

    // Valida se o ID foi fornecido
    if (!isset($data['id'])) {
        throw new Exception("ID não fornecido.");
    }

    $id = $data['id'];

    // Atualiza o campo boat_id na tabela trator_oleo
    $stmt = $conn->prepare("
        UPDATE trator_oleo
        SET boat_id = ?
    ");
    if (!$stmt) {
        throw new Exception("Erro ao preparar consulta SQL: " . $conn->error);
    }

    // Vincula o valor ao parâmetro
    $stmt->bind_param("s", $id);

    // Executa a consulta
    if (!$stmt->execute()) {
        throw new Exception("Erro ao executar a consulta: " . $stmt->error);
    }

    // Retorna uma mensagem de sucesso
    echo json_encode(["status" => "success", "message" => "boat_id atualizado com sucesso!"]);

    // Fecha o statement e a conexão
    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    // Retorna o erro como resposta
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
