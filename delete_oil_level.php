<?php
include 'db.php';

header('Content-Type: application/json; charset=utf-8');

try {
    // Registra a entrada no log para depuração
    file_put_contents('debug.log', "[" . date('Y-m-d H:i:s') . "] Início da requisição\n", FILE_APPEND);

    // Captura os dados enviados pelo frontend
    $data = json_decode(file_get_contents("php://input"), true);

    // Valida se o 'boat_id' foi fornecido
    if (!isset($data['boat_id']) || empty($data['boat_id'])) {
        throw new Exception("Dados incompletos. O campo 'boat_id' é obrigatório.");
    }

    $boat_id = intval($data['boat_id']);
    file_put_contents('debug.log', "[" . date('Y-m-d H:i:s') . "] Boat ID recebido: $boat_id\n", FILE_APPEND);

    // Prepara a consulta SQL para deletar o registro com base no 'boat_id'
    $stmt = $conn->prepare("DELETE FROM trator_oleo WHERE boat_id = ?");
    if (!$stmt) {
        throw new Exception("Erro ao preparar consulta SQL: " . $conn->error);
    }

    // Vincula o parâmetro à consulta
    $stmt->bind_param("i", $boat_id);
    $stmt->execute();
    file_put_contents('debug.log', "[" . date('Y-m-d H:i:s') . "] Consulta executada. Linhas afetadas: " . $stmt->affected_rows . "\n", FILE_APPEND);

    // Verifica se o registro foi removido com sucesso
    if ($stmt->affected_rows > 0) {
        echo json_encode(["status" => "success", "message" => "Registro removido com sucesso!", "deleted_boat_id" => $boat_id]);
    } else {
        throw new Exception("Nenhum registro encontrado com o 'boat_id' fornecido.");
    }

    // Fecha o statement e a conexão
    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    // Registra o erro no log para depuração
    file_put_contents('debug.log', "[" . date('Y-m-d H:i:s') . "] Erro: " . $e->getMessage() . "\n", FILE_APPEND);

    // Retorna o erro como resposta
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
