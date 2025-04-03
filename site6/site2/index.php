<!DOCTYPE html>
<html lang="pt">
<head>
  <title>Carlito's Locações - ID Barbante</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Locação de máquinas e equipamentos para linha de transmissão.">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
  /* Garantindo que a página ocupe toda a altura */
  html, body {
    margin: 0;
    padding: 0;
    height: 100%;
  }
  @media (max-width: 768px) {
    iframe {
        height: auto;
    }
}

 .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 */
            padding-top: 25px;
            height: 0;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
  /* Configurando o layout das seções de fundo */
  .bg {
    background-color: #6d0505; /* Cor do fundo */
    color: #ffffff;
    width: 100%; /* Ocupa toda a largura da página */
    min-height: 100vh; /* Garante altura mínima de 100% da janela */
    display: flex;
    flex-direction: column; /* Alinha os elementos verticalmente */
    justify-content: center; /* Centraliza o conteúdo verticalmente */
    align-items: center; /* Centraliza o conteúdo horizontalmente */
    text-align: center; /* Centraliza o texto */
  }

  body {
    font: 22px Montserrat, sans-serif;
    line-height: 1.8;
    color: #f5f6f7;
  }

  input {
    color: black;
  }

  button {
    background-color: #1abc9c;
    color: #ffffff;
    font-size: 16px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  button:hover {
    background-color: #16a085;
  }

  .navbar {
    padding-top: 3px;
    padding-bottom: 3px;
    border: 0;
    border-radius: 0;
    margin-bottom: 0;
    font-size: 11px;
    letter-spacing: 5px;
  }

  .navbar-nav li a:hover {
    color: #1abc9c !important;
  }
  </style>
</head>
<body>
<!-- Primeira seção com fundo -->
<div class="bg">
  <form method="GET" action="../site/msg.php">
    <label for="id">Cadastrar Trator no Contrato por ID:</label>
    <input type="text" id="id" name="id" required>
    <button type="submit">Buscar</button><br>
  </form><br>
  
</div>
<!-- Segunda seção com fundo -->

<div class="bg">
        <iframe src="https://www.youtube.com/embed/WJxKJyrunJ0?si=-6wOWVuH77uB7PWC" frameborder="0" allowfullscreen style="width: 100%; height: 100vh;"></iframe>
  <img src="https://carlitoslocacoes.com/site2/carlitoschapeu.png" width="300" height="300"><br>
  <img src="https://carlitoslocacoes.com/site2/fontcarlitos.png" width="400" height="400">
</div>
</body>
</html>
