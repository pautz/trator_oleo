<?php
include 'db.php';
include 'registrar_edicao.php'; // Inclui a função para registrar edições
session_start();

try {
    // Decodifica os dados enviados pelo frontend
    $data = json_decode(file_get_contents("php://input"), true);

    // Valida os dados enviados
    if (!isset($data['boat_id'], $data['field'], $data['value'])) {
        throw new Exception("Dados incompletos. Certifique-se de enviar o campo boat_id, field e value.");
    }

    $boat_id = intval($data['boat_id']); // Garante que boat_id seja um número inteiro
    $field = $data['field']; // Captura o nome do campo a ser atualizado
    $value = $data['value']; // Captura o novo valor

    // Lista de campos permitidos para atualização
    $allowedFields = ['oil_level', 'next_change', 'next_change_value', 'whatsapp_number', 'paymentstatus'];
    if (!in_array($field, $allowedFields)) {
        throw new Exception("Campo inválido. Atualizações são permitidas apenas nos campos: " . implode(", ", $allowedFields));
    }

    // Formata a data, se o campo for next_change
    if ($field === 'next_change') {
        $value = date('Y-m-d', strtotime($value));
        if (!$value || $value === "1970-01-01") {
            throw new Exception("Data inválida para o campo Próxima Prestação.");
        }
    }

    // Busca o valor antigo antes de atualizar
    $stmt_select = $conn->prepare("SELECT $field FROM trator_oleo WHERE boat_id = ?");
    if (!$stmt_select) {
        throw new Exception("Erro ao preparar consulta de seleção: " . $conn->error);
    }
    $stmt_select->bind_param("i", $boat_id);
    $stmt_select->execute();
    $resultado = $stmt_select->get_result();
    $registro_antigo = $resultado->fetch_assoc();
    $valor_antigo = $registro_antigo[$field] ?? null; // Valor antigo do campo
    $stmt_select->close();

    // Prepara a consulta para atualizar registros
    $stmt_update = $conn->prepare("UPDATE trator_oleo SET $field = ? WHERE boat_id = ?");
    if (!$stmt_update) {
        throw new Exception("Erro ao preparar consulta SQL: " . $conn->error);
    }

    $stmt_update->bind_param("si", $value, $boat_id);
    $stmt_update->execute();

    // Verifica se o registro foi atualizado
    if ($stmt_update->affected_rows > 0) {
        // Registra a edição no histórico
        registrarEdicao($conn, "trator_oleo", $boat_id, $field, $valor_antigo, $value, "Sistema");

        echo json_encode([
            "status" => "success",
            "message" => "Campo atualizado com sucesso!",
            "updated_field" => $field,
            "new_value" => $value
        ]);
    } else {
        echo json_encode([
            "status" => "success",
            "message" => "Nenhuma alteração detectada.",
            "updated_field" => $field,
            "new_value" => $value
        ]);
    }

    // Fecha recursos
    $stmt_update->close();
    $conn->close();
} catch (Exception $e) {
    // Log de erros detalhado
    file_put_contents('debug.log', "[" . date('Y-m-d H:i:s') . "] Erro: " . $e->getMessage() . PHP_EOL, FILE_APPEND);

    // Retorna erro ao frontend com código apropriado
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
