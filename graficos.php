 <?php
// Inicializar a sessão
session_start();
 
// Verificar se o usuário está logado
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../site/login.php"); // Redirecionar para login.php se não estiver logado
    exit;
}

// Incluir arquivos adicionais somente se necessário
include 'lib.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Troca de Óleo</title>
    
    <h1>Olá, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Seja Bem Vindo.</h1>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .red {
            background-color: #ffcccc;
        }

        canvas {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        h1 {
            font-size: 2em;
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        input[type="text"], button {
            width: 90%;
            max-width: 400px;
            padding: 10px;
            margin: 10px auto;
            display: block;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #36A2EB;
            color: white;
            cursor: pointer;
            font-size: 1em;
        }

        button:hover {
            background-color: #2c89d3;
        }

        #chartsContainer {
            display: none;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 1.5em;
            }

            input[type="text"], button {
                font-size: 0.9em;
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <h1>Gráfico de Troca de Óleo por Contrato e Trator</h1>

    <label for="cvInput">Filtrar por Número do Trator:</label>
    <input type="text" id="cvInput" placeholder="Digite o número do trator">
    <button onclick="filterCharts()">Filtrar</button>

    <div id="tableContainer"></div>
    <div id="chartsContainer"></div>

    <?php
    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "u839226731_cztuap";
    $password = "Meu6595869Trator";
    $dbname = "u839226731_meutrator";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT boat_id, oil_level, next_change_value, next_change, cv
FROM oil_levels
WHERE eq_user = :username
ORDER BY (next_change_value - oil_level) ASC;");
$stmt->bindParam(':username', $_SESSION["username"], PDO::PARAM_STR);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);


        // Transformar os dados em JSON para uso no JavaScript
        echo "<script>const data = " . json_encode($data) . ";</script>";
    } catch (PDOException $e) {
        echo "<p>Erro na conexão: " . $e->getMessage() . "</p>";
    }
    ?>

    <script>
        const tableContainer = document.getElementById('tableContainer');
        const chartsContainer = document.getElementById('chartsContainer');
        const cvInput = document.getElementById('cvInput');

        // Função para gerar tabela
        function generateTable() {
            const currentDate = new Date(); // Data atual

            // Ordena os dados para que os itens em vermelho fiquem no topo
            const sortedData = data.sort((a, b) => {
                const remainingA = a.next_change_value - a.oil_level;
                const remainingB = b.next_change_value - b.oil_level;
                const nextChangeDateA = new Date(a.next_change);
                const nextChangeDateB = new Date(b.next_change);

                // Prioriza os itens em vermelho (por nível de óleo ou próxima troca)
                if (remainingA <= 0 || nextChangeDateA <= currentDate) return -1;
                if (remainingB <= 0 || nextChangeDateB <= currentDate) return 1;
                return 0;
            });

            let tableHTML = `
                <table>
                    <thead>
                        <tr>
                            <th>Contrato</th>
                            <th>Número do Trator</th>
                            <th>Nível de Óleo</th>
                            <th>Próxima Troca</th>
                            <th>Restante</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            sortedData.forEach(item => {
                const remaining = item.next_change_value - item.oil_level;
                const isRedLevel = remaining <= 0 ? 'red' : '';
                const nextChangeDate = new Date(item.next_change);
                const isRedDate = nextChangeDate <= currentDate ? 'red' : '';

                tableHTML += `
                    <tr>
                        <td>${item.boat_id}</td>
                        <td>${item.cv}</td>
                        <td class="${isRedLevel}">${item.oil_level}</td>
                        <td class="${isRedDate}">${item.next_change}</td>
                        <td>${remaining.toFixed(2)}</td>
                    </tr>
                `;
            });

            tableHTML += `</tbody></table>`;
            tableContainer.innerHTML = tableHTML;
        }

        // Gera a tabela ao carregar a página
        generateTable();

        // Função para filtrar e exibir gráficos
        function filterCharts() {
            const enteredCv = cvInput.value.trim();
            if (enteredCv === '') {
                alert('Por favor, insira um número de trator válido.');
                return;
            }

            const filteredData = data.filter(item => item.cv.toString() === enteredCv);
            if (filteredData.length === 0) {
                alert('Nenhum gráfico encontrado para este número de trator.');
                chartsContainer.style.display = 'none';
                return;
            }

            chartsContainer.style.display = 'block';
            generateCharts(filteredData);
        }

        // Função para gerar gráficos
        function generateCharts(filteredData) {
            chartsContainer.innerHTML = ''; // Limpa os gráficos existentes
            filteredData.forEach((item, index) => {
                const canvas = document.createElement('canvas');
                canvas.id = `chart-${index}`;
                canvas.width = 400;
                canvas.height = 200;
                chartsContainer.appendChild(canvas);

                const ctx = canvas.getContext('2d');

                const percentageUsed = (item.oil_level / item.next_change_value) * 100;
                const percentageRemaining = 100 - percentageUsed;

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Já Usado (%)', 'Faltando (%)'],
                        datasets: [{
                            data: [percentageUsed.toFixed(2), percentageRemaining.toFixed(2)],
                            backgroundColor: ['#FF6384', '#36A2EB'],
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: `Trator ${item.cv} - Contrato ${item.boat_id}`,
                            }
                        }
                    }
                });
            });
        }
    </script>
</body>
</html>
