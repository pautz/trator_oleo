<?php
session_start(); // Inicia a sessão

// Captura o ID da URL
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Erro: Nenhum ID fornecido na URL.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Tipo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style>
        .container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .form-control { margin-bottom: 10px; }
    </style>
</head>
<body>
    <a href="https://carlitoslocacoes.com/site6/site2" class="btn btn-primary btn-xl">Início</a>
    <div class="container">
        <h1>Cadastrar Trator no Contrato</h1>
        <!-- Exibe o ID capturado -->
        <p><strong>ID:</strong> <?php echo htmlspecialchars($id); ?></p>
        <form method="POST" action="cadastro/cadastro.php">
            <input type="hidden" name="cv" value="<?php echo htmlspecialchars($id); ?>" />
            <div class="form-group">
                <label for="tipo">Tipo:<span style="color: red;">*</span>:</label>
                <input type="text" name="tipo" id="tipo" class="form-control" placeholder="Trator Valtra BM125" required />
            </div>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
    </div>
</body>
</html>
