document.addEventListener("DOMContentLoaded", function() {
    const calendarInput = document.querySelector("#data");
    const calendarButton = document.querySelector("#calendarButton");
    const selectedDateSpan = document.querySelector("#selectedDate"); // Elemento para exibir a data selecionada
    const horaSelect = document.querySelector("#hora");
    const quadraSelect = document.querySelector("#quadra");

    // Inicializa o Flatpickr para a data
    const calendar = flatpickr(calendarInput, {
        dateFormat: "d-m-Y", // Formato compatível com o backend
        minDate: "today",
        locale: "pt",
        onChange: function(selectedDates, dateStr) {
            if (dateStr) {
                // Atualiza o texto do span com a data selecionada
                selectedDateSpan.textContent = `${dateStr}`;

                // Atualiza as quadras com base na data e hora selecionadas
                atualizarQuadras(dateStr, horaSelect.value);
            } else {
                selectedDateSpan.textContent = "Selecione uma data";
            }
        }
    });

    // Atualiza as quadras quando o horário é alterado
    horaSelect.addEventListener("change", function() {
        const dateStr = calendarInput.value; // Obtém a data selecionada
        const hora = horaSelect.value; // Obtém o horário selecionado

        if (dateStr && hora) {
            atualizarQuadras(dateStr, hora);
        }
    });

    // Função para atualizar as quadras indisponíveis
    function atualizarQuadras(data, hora) {
        if (data && hora) {
            // Verifica se a data está no formato correto (d-m-Y)
            const dateRegex = /^\d{2}-\d{2}-\d{4}$/;
            if (!dateRegex.test(data)) {
                console.error("Formato de data inválido:", data);
                return; // Sai da função se o formato estiver incorreto
            }

            const url = `/dashboard/novo-agendamento/${data}/${hora}`;

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(quadrasIndisponiveis => {
                    // Reseta as opções do select de quadras
                    const options = quadraSelect.querySelectorAll("option");
                    options.forEach(option => {
                        option.disabled = false;
                        option.style.color = "";
                    });

                    // Desabilita a opção "Selecione a quadra"
                    const defaultOption = quadraSelect.querySelector('option[value=""]');
                    if (defaultOption) {
                        defaultOption.disabled = true;
                        defaultOption.style.color = "gray";
                    }

                    // Desabilita as quadras indisponíveis
                    quadrasIndisponiveis.forEach(quadra => {
                        const option = quadraSelect.querySelector(`option[value="${quadra}"]`);
                        if (option) {
                            option.disabled = true;
                            option.style.color = "red";
                        }
                    });
                })
                .catch(error => console.error("Erro ao buscar quadras indisponíveis:", error));
        }
    }

    // Abre o calendário ao clicar no botão
    calendarButton.addEventListener("click", function() {
        calendar.open();
    });

    // Controle de etapas do formulário
    const steps = document.querySelectorAll('.step');
    let currentStep = 0;

    function showStep(index) {
        steps.forEach((step, i) => {
            step.style.display = i === index ? 'block' : 'none';
        });
    }

    // Botões "Prosseguir"
    document.querySelectorAll('.nextButton').forEach((button, index) => {
        button.addEventListener('click', () => {
            if (index === steps.length - 2) {
                // Preencher os dados de confirmação
                document.getElementById('confirmData').textContent = document.getElementById('selectedDate').textContent;
                document.getElementById('confirmHora').textContent = document.getElementById('hora').value;
                document.getElementById('confirmQuadra').textContent = document.getElementById('quadra').value;
            }
            currentStep++;
            showStep(currentStep);
        });
    });

    // Botões "Voltar"
    document.querySelectorAll('.prevButton').forEach((button) => {
        button.addEventListener('click', () => {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });
    });

    // Verifica se o usuário tenta selecionar uma opção desabilitada
    quadraSelect.addEventListener("change", function () {
        const selectedOption = quadraSelect.options[quadraSelect.selectedIndex];
        if (selectedOption.disabled) {
            alert("Esta quadra não está disponível para o horário selecionado.");
            quadraSelect.value = ""; // Reseta a seleção
        }
    });

    // Inicializa a exibição da primeira etapa
    showStep(currentStep);
});


/* Utilizado para teste, não vou retirar por caso tenha que usar novamente já tenha.

fetch('http://127.0.0.1:8000/dashboard/novo-agendamento/')
    .then(response => {
        console.log("Resposta bruta:", response); // Verifica a resposta
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(quadrasIndisponiveis => {
        console.log("Quadras indisponíveis:", quadrasIndisponiveis);
        // Lógica para desabilitar as opções
    })
    .catch(error => console.error("Erro ao buscar quadras indisponíveis:", error));

*/
