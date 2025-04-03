<!DOCTYPE html>
<html>
<head>
    <title>Gráficos e Dados de Níveis de Óleo</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
</head>
<body>
    <h2>Gráficos e Dados de Níveis de Óleo</h2>
    <form method="GET" action="">
        <label for="boat-id">Filtrar por ID da Lancha:</label>
        <input type="text" id="boat-id" name="boat_id" placeholder="ID da Lancha">
        <button type="submit">Filtrar</button>
    </form>

    <div style="width: 70%; margin: 20px auto;">
        <canvas id="oilChart"></canvas>
    </div>

    <div style="width: 70%; margin: 20px auto;">
        <canvas id="dateChart"></canvas>
    </div>

    <?php
    // Inclui a conexão com o banco de dados
    include 'db.php';

    // Verificar se um ID foi passado
    $boat_id = isset($_GET['boat_id']) ? $_GET['boat_id'] : null;

    if ($boat_id) {
    $stmt = $conn->prepare("SELECT oil_level, next_change_value FROM oil_levels WHERE boat_id = ?");
    $stmt->bind_param("s", $boat_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = []; // Armazena os valores
    while ($row = $result->fetch_assoc()) {
        $data[] = $row['oil_level']; // Nível de óleo
        $data[] = $row['next_change_value']; // Valor da próxima troca
    }
    $stmt->close();
}

 else {
        // Dados para o gráfico de dispersão de óleo e valor
        $query = "SELECT boat_id, oil_level, next_change_value FROM oil_levels";
        $result = $conn->query($query);

        $scatterData = [];
        $scatterColors = [];
        while ($row = $result->fetch_assoc()) {
            $scatterData[] = [
                'x' => $row['oil_level'],
                'y' => $row['next_change_value'],
                'label' => "ID: " . $row['boat_id']
            ];
            // Define a cor dos pontos
            $scatterColors[] = $row['oil_level'] >= $row['next_change_value'] ? '#f44336' : '#36a2eb';
        }
    }

    // Dados para o gráfico de dispersão de datas
    $queryDates = "SELECT boat_id, next_change FROM oil_levels";
    $resultDates = $conn->query($queryDates);

    $dateData = [];
    while ($row = $resultDates->fetch_assoc()) {
        $dateData[] = [
            'x' => $row['boat_id'],
            'y' => strtotime($row['next_change']) * 1000 // Converte a data para timestamp em milissegundos
        ];
    }

    $conn->close();
    ?>

    <!-- Tabela com as Datas de Próxima Troca -->
    <h3>Lista de Datas de Próxima Troca</h3>
    <table border="1" style="width: 70%; margin: 20px auto; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID da Lancha</th>
                <th>Data da Próxima Troca</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $now = time() * 1000; // Timestamp atual em milissegundos
            foreach ($dateData as $point): 
            ?>
            <tr>
                <td style="color: <?php echo $point['y'] <= $now ? '#f44336' : '#000000'; ?>;">
                    <?php echo $point['x']; ?>
                </td>
                <td style="color: <?php echo $point['y'] <= $now ? '#f44336' : '#000000'; ?>;">
                    <?php echo date('d/m/Y', $point['y'] / 1000); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Tabela de Níveis de Óleo -->
    <h3>Lista de Dados das Marcações</h3>
    <table border="1" style="width: 70%; margin: 20px auto; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID da Lancha</th>
                <th>Nível de Óleo</th>
                <th>Valor da Próxima Troca</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($scatterData as $point): ?>
            <tr>
                <td style="color: <?php echo $point['x'] >= $point['y'] ? '#f44336' : '#000000'; ?>;">
                    <?php echo $point['label']; ?>
                </td>
                <td style="color: <?php echo $point['x'] >= $point['y'] ? '#f44336' : '#000000'; ?>;">
                    <?php echo $point['x']; ?>
                </td>
                <td style="color: <?php echo $point['x'] >= $point['y'] ? '#f44336' : '#000000'; ?>;">
                    <?php echo $point['y']; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        const oilCtx = document.getElementById('oilChart').getContext('2d');
        const dateCtx = document.getElementById('dateChart').getContext('2d');

        <?php if ($boat_id): ?>
        // Gráfico de Pizza
      <?php if ($boat_id): ?>
// Gráfico de Pizza para comparar Nível de Óleo e Valor da Próxima Troca
new Chart(oilCtx, {
    type: 'pie',
    data: {
        labels: ['Nível de Óleo', 'Valor da Próxima Troca'], // Rótulos para as fatias
        datasets: [{
            data: [
                <?php echo $data[0]; ?>, // Nível de óleo (valor absoluto)
                <?php echo $data[1]; ?>  // Valor da próxima troca (valor absoluto)
            ],
            backgroundColor: ['#36a2eb', '#ff6384'], // Azul para nível de óleo, vermelho para próxima troca
            hoverOffset: 10
        }]
    },
    options: {
        plugins: {
            datalabels: {
                formatter: (value, context) => {
                    // Calcula o total de valores no dataset
                    let total = context.chart.data.datasets[0].data.reduce((sum, current) => sum + current, 0);

                    // Calcula a porcentagem relativa a cada fatia
                    let percentage = ((value / total) * 100).toFixed(2);

                    // Retorna o texto com valor absoluto e porcentagem
                    return `Valor: ${value}\n(${percentage}%)`;
                },
                color: '#fff', // Cor do texto
                font: {
                    size: 14,
                    weight: 'bold' // Texto em negrito
                },
                align: 'end' // Alinha o texto próximo à borda
            },
            title: {
                display: true,
                text: `Comparação de Nível de Óleo e Valor da Próxima Troca (ID: <?php echo $boat_id; ?>)`
            },
            legend: {
                position: 'bottom' // Exibe a legenda na parte inferior
            }
        }
    }
});
<?php endif; ?>



        <?php else: ?>
        // Gráfico de Dispersão de Óleo e Valor
        new Chart(oilCtx, {
            type: 'scatter',
            data: {
                datasets: [{
                    label: 'Nível de Óleo por Valor da Próxima Troca (Todos os IDs)',
                    data: <?php echo json_encode($scatterData); ?>,
                    pointBackgroundColor: <?php echo json_encode($scatterColors); ?>
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                const point = tooltipItem.raw;
                                return `${point.label}: Óleo=${point.x}, Valor=${point.y}`;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Dispersão: Nível de Óleo por Valor da Próxima Troca (Todos os IDs)'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Nível de Óleo'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Valor da Próxima Troca'
                        }
                    }
                }
            }
        });

        // Gráfico de Dispersão de Datas
        new Chart(dateCtx, {
            type: 'scatter',
            data: {
                datasets: [{
                    label: 'Distribuição de Datas de Próxima Troca (Todos os IDs)',
                    data: <?php echo json_encode($dateData); ?>,
                    backgroundColor: function(context) {
                        const point = context.raw;
                        const now = Date.now();
                        return point.y <= now ? '#f44336' : '#ff6384'; // Vermelho para datas atingidas ou ultrapassadas, rosa para futuras
                    }
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                const point = tooltipItem.raw;
                                const formattedDate = new Date(point.y).toLocaleDateString();
                                return `${point.x}: Data=${formattedDate}`;
                            }
                        }
                    },
                                        title: {
                        display: true,
                        text: 'Dispersão: Datas de Próxima Troca (Todos os IDs)'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'ID da Lancha'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Próxima Troca (Data)'
                        },
                        ticks: {
                            callback: function(value) {
                                const date = new Date(value);
                                return date.toLocaleDateString();
                            }
                        }
                    }
                }
            }
        });
        <?php endif; ?>
        
    </script>
</body>
</html>
