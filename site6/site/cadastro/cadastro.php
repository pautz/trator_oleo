<?php
session_start(); // Inicia a sessão

// Configuração de conexão com o banco
$dbhost = "localhost";
$dbuser = "u839226731_cztuap";
$dbpass = "Meu6595869Trator";
$dbname = "u839226731_meutrator";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Valida e sanitiza os dados
$cv = $_POST['cv'] ?? null;
$tipo = $_POST['tipo'] ?? null;

if (!$cv || !$tipo) {
    die("Erro: O CV e o Tipo são obrigatórios.");
}

// Prepara e executa o SQL
$stmt = $conn->prepare("INSERT INTO respostas3 (cv, tipo) VALUES (?, ?)");
$stmt->bind_param("ss", $cv, $tipo);

if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
    header("Location: /trator_oleo"); // Redireciona para uma página de sucesso (opcional)
    exit();
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
