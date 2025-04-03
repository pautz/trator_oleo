<?php
include 'db.php'; // Conexão com o banco de dados

try {
    // Consulta ao banco filtrando exclusivamente os IDs com caixa vazio
    $stmt = $conn->prepare("
        SELECT DISTINCT cv, id 
        FROM respostas3 
        WHERE TRIM(caixa) = ''
    ");
    if (!$stmt) {
        throw new Exception("Erro ao preparar consulta SQL: " . $conn->error);
    }

    // Executa a consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Monta o array de respostas
    $respostas = [];
    while ($row = $result->fetch_assoc()) {
        $respostas[] = $row;
    }

    // Retorna os dados como JSON
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($respostas);

    // Libera recursos
    $result->free();
    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    // Log de erros para depuração
    file_put_contents(
        'debug.log',
        "[" . date('Y-m-d H:i:s') . "] Erro: " . $e->getMessage() . PHP_EOL,
        FILE_APPEND
    );

    // Retorna mensagem de erro ao frontend
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
