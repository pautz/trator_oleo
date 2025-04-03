<?php
$servername = "localhost";
$username = "u839226731_cztuap";
$password = "Meu6595869Trator";
$dbname = "u839226731_meutrator";

// Criando conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
