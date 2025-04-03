<?php
include 'db.php';

try {
    // Consulta SQL para buscar os registros, incluindo boat_id
    $stmt = $conn->prepare("SELECT boat_id, cv, oil_level, next_change, next_change_value, whatsapp_number, paymentstatus FROM trator_oleo");
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // Cada linha da tabela é adicionada aqui
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
