<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Níveis de Óleo</title>
    <style>
        .btn-inicio {
            background-color: #FF9800;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-family: Arial, sans-serif;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto;
        }

        .btn-inicio:hover {
            background-color: #F57C00;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .form-container, .table-container {
            width: 90%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .highlight-red {
            background-color: red;
            color: white;
            font-weight: bold;
        }

        .highlight-blue {
            background-color: blue;
            color: white;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Adicionar Registro</h2>
        <button class="btn-inicio" onclick="location.href='/trator_oleo/site6/site2'">Ínicio</button><br>
        
        <label for="cv">Selecionar Contrato (boat_id):</label>
        <select id="cv" required>
            <option value="" disabled selected>Selecione...</option>
        </select>

        <label for="id">Selecionar Prestação:</label>
        <select id="id" required>
            <option value="" disabled selected>Selecione um ID...</option>
        </select>

        <input type="number" id="oil-level" placeholder="Nivel do Oleo" required>
        <input type="date" id="next-change" required>
        <input type="number" step="0.01" id="next-change-value" placeholder="Valor da Próxima Troca" required>
        <input type="text" id="whatsapp-number" placeholder="Número do WhatsApp" required>
        <select id="paymentstatus">
            <option value="Não Pago" selected>Não Pago</option>
            <option value="Pago">Pago</option>
        </select>
        <button onclick="addOilLevel()">Adicionar</button>
    </div>

    <div class="table-container">
        <h2>Registros</h2>
        <table>
            <thead>
                <tr>
                    <th>Prestação</th>
                    <th>Contrato</th>
                    <th>Nivel do Oleoo</th>
                    <th>Data da Próxima Troca</th>
                    <th>Valor da Próxima Troca</th>
                    <th>WhatsApp</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="oil-levels-table"></tbody>
        </table>
    </div>

    <script>
        async function loadSelectOptions() {
            try {
                const response = await fetch('get_respostas.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' }
                });

                if (!response.ok) {
                    throw new Error("Erro ao carregar dados do servidor.");
                }

                const respostas = await response.json();
                const cvSelect = document.getElementById('cv');
                cvSelect.innerHTML = '<option value="" disabled selected>Selecione...</option>';
                const uniqueCVs = [...new Set(respostas.map(resposta => resposta.cv))];

                uniqueCVs.forEach(cv => {
                    const cvOption = document.createElement('option');
                    cvOption.value = cv;
                    cvOption.textContent = cv;
                    cvSelect.appendChild(cvOption);
                });

                cvSelect.addEventListener('change', async function () {
                    const cvValue = this.value;
                    const idSelect = document.getElementById('id');

                    if (!cvValue) {
                        idSelect.innerHTML = '<option value="" disabled selected>Selecione um ID...</option>';
                        return;
                    }

                    const response = await fetch('get_ids_by_cv.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ cv: cvValue })
                    });

                    const ids = await response.json();
                    idSelect.innerHTML = '<option value="" disabled selected>Selecione um ID...</option>';
                    const uniqueIDs = [...new Set(ids)];

                    uniqueIDs.forEach(id => {
                        const idOption = document.createElement('option');
                        idOption.value = id;
                        idOption.textContent = id;
                        idSelect.appendChild(idOption);
                    });
                });
            } catch (error) {
                alert("Erro ao carregar opções: " + error.message);
                console.error(error);
            }
        }

        async function addOilLevel() {
            try {
                const boat_id = document.getElementById('id').value;
                const cv = document.getElementById('cv').value;
                const oilLevel = document.getElementById('oil-level').value;
                const nextChange = document.getElementById('next-change').value;
                const nextChangeValue = document.getElementById('next-change-value').value;
                const whatsapp_number = document.getElementById('whatsapp-number').value;
                const paymentstatus = document.getElementById('paymentstatus').value;

                if (!boat_id || !cv || !oilLevel || !nextChange || !nextChangeValue || !whatsapp_number || !paymentstatus) {
                    alert("Por favor, preencha todos os campos.");
                    return;
                }

                const response = await fetch('add_oil_level.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        boat_id,
                        cv,
                        oilLevel,
                        nextChange,
                        nextChangeValue,
                        whatsapp_number,
                        paymentstatus,
                    }),
                });

                if (!response.ok) {
                    throw new Error("Erro ao adicionar registro.");
                }

                const result = await response.json();
                alert(result.message);
                loadOilLevels(); // Atualiza os registros
            } catch (error) {
                console.error("Erro ao adicionar registro:", error);
                alert("Erro ao adicionar registro: " + error.message);
            }
        }

        async function loadOilLevels() {
            try {
                const response = await fetch('get_oil_levels.php');
                if (!response.ok) {
                    throw new Error("Erro ao carregar os registros.");
                }

                const levels = await response.json();
                const tableBody = document.getElementById('oil-levels-table');
                tableBody.innerHTML = ''; // Limpa registros anteriores

                if (!levels || levels.length === 0) {
                    const row = document.createElement('tr');
                    row.innerHTML = '<td colspan="8">Nenhum registro encontrado.</td>';
                    tableBody.appendChild(row);
                    return;
                }

                levels.sort((a, b) => {
                    const now = new Date();

                    if (new Date(a.next_change) <= now && a.paymentstatus !== "Pago") return -1;
                    if (new Date(b.next_change) <= now && b.paymentstatus !== "Pago") return 1;

                    if (a.paymentstatus === "Pago" && b.paymentstatus !== "Pago") return -1;
                    if (b.paymentstatus === "Pago" && a.paymentstatus !== "Pago") return 1;

                    return 0;
                });

                levels.forEach(level => {
    const row = document.createElement('tr');

    // Aplica a classe apropriada com base no status e na data
    if (new Date(level.next_change) <= new Date() && level.paymentstatus === "Não Pago") {
        row.classList.add('highlight-red');
    } else if (level.paymentstatus === "Pago") {
        row.classList.add('highlight-blue');
    }

    row.innerHTML = `
        <td>${level.boat_id}</td>
        <td contenteditable="true" data-old-value="${level.cv}" onblur="updateField(this, 'cv', '${level.boat_id}')">${level.cv}</td>
        <td contenteditable="true" data-old-value="${level.oil_level}" onblur="updateField(this, 'oil_level', '${level.boat_id}')">${level.oil_level}</td>
        <td contenteditable="true" data-field="next_change" data-old-value="${level.next_change}" onblur="updateField(this, 'next_change', '${level.boat_id}')">${level.next_change}</td>
        <td contenteditable="true" data-old-value="${level.next_change_value}" onblur="updateField(this, 'next_change_value', '${level.boat_id}')">${level.next_change_value}</td>
        <td contenteditable="true" data-old-value="${level.whatsapp_number}" onblur="updateField(this, 'whatsapp_number', '${level.boat_id}')">${level.whatsapp_number}</td>
        <td>
            <select onchange="updateField(this, 'paymentstatus', '${level.boat_id}')">
                <option value="Não Pago" ${level.paymentstatus === "Não Pago" ? "selected" : ""}>Não Pago</option>
                <option value="Pago" ${level.paymentstatus === "Pago" ? "selected" : ""}>Pago</option>
            </select>
        </td>
       <td>
    <button onclick="sendToWhatsApp('${level.cv}', '${level.boat_id}', '${level.oil_level}', '${level.next_change}', '${level.next_change_value}', '${level.whatsapp_number}')">
        Enviar para WhatsApp
    </button>
        <button onclick="removeOilLevel('${level.boat_id}')">Remover</button>
        </td>
    `;
    tableBody.appendChild(row);
});

            } catch (error) {
                console.error("Erro ao carregar registros:", error);
                alert("Erro ao carregar registros: " + error.message);
            }
        }

        async function updateField(element, field, boat_id) {
    const newValue = element.tagName === "SELECT" ? element.value : element.textContent.trim(); // Captura o valor atualizado
    const oldValue = element.getAttribute('data-old-value'); // Valor antigo para comparação

    if (newValue === oldValue) {
        console.log("Nenhuma alteração detectada no campo:", field);
        return; // Não faz nada se não houver mudanças
    }

    try {
        const response = await fetch('update_oil_level.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ boat_id, field, value: newValue }),
        });

        if (!response.ok) {
            throw new Error("Erro ao atualizar o campo.");
        }

        const result = await response.json();
        if (result.status === "success") {
            // Atualiza o valor antigo após sucesso
            element.setAttribute('data-old-value', newValue);

            // Obtém a linha da tabela
            const row = element.closest('tr');

            // Atualiza dinamicamente as cores com base no status e na data
            if (field === "paymentstatus" || field === "next_change") {
                const paymentStatus = row.querySelector('select').value;
                const nextChangeDate = new Date(row.querySelector('[data-field="next_change"]').textContent.trim());
                const currentDate = new Date();

                row.classList.remove('highlight-red', 'highlight-blue'); // Remove classes de cor anteriores

                if (paymentStatus === "Pago") {
                    row.classList.add('highlight-blue'); // Linha azul para pagamentos
                } else if (paymentStatus === "Não Pago" && nextChangeDate <= currentDate) {
                    row.classList.add('highlight-red'); // Linha vermelha para não pagos com data atingida
                }
            }

            alert("Campo atualizado com sucesso!");
        } else {
            alert(`Erro ao atualizar: ${result.message}`);
        }
    } catch (error) {
        console.error("Erro ao atualizar o campo:", error);
        alert("Erro ao atualizar o campo: " + error.message);
    }
}

      async function removeOilLevel(boat_id) {
    console.log("Boat ID enviado para remoção:", boat_id); // Confirme que o boat_id correto está sendo enviado

    if (!confirm("Tem certeza de que deseja remover este registro?")) {
        return; // Cancela a exclusão caso o usuário desista
    }

    try {
        const response = await fetch('delete_oil_level.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ boat_id }), // Envia o boat_id ao backend
        });

        if (!response.ok) {
            throw new Error("Erro ao remover registro.");
        }

        const result = await response.json();
        alert(result.message);
        loadOilLevels(); // Atualiza a tabela após a exclusão
    } catch (error) {
        console.error("Erro ao remover registro:", error);
        alert("Erro ao remover registro: " + error.message);
    }
}


       function sendToWhatsApp(cv, boat_id, oilLevel, nextChange, nextChangeValue, whatsappNumber) {
    const message = `Contrato: ${cv}\nTrator: ${boat_id}\nNivel do Oleo: ${oilLevel}\nData da Proxima Troca: ${nextChange}\nValor da Próxima Troca: ${nextChangeValue}`;
    const url = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;
    window.open(url, '_blank');
}

        // Carrega os selects e os registros ao carregar a página
        window.onload = function () {
            loadSelectOptions();
            loadOilLevels();
        };
    </script>
</body>
</html>
