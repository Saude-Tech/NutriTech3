function updateWater(glasses) {

    const formData = new URLSearchParams();
    formData.append("glasses", glasses);

    fetch("/dashboard/updateWater", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: formData
    })
        .then(async (response) => {

            if (!response.ok) {
                const text = await response.text();
                console.error("Erro do servidor:", text);
                throw new Error("Erro no servidor: " + response.status);
            }

            return response.json();
        })
        .then(data => {

            if (!data.success) return;

            const drops = document.querySelectorAll("#water-tracker .water-drop");

            drops.forEach((drop, index) => {
                drop.classList.toggle("filled", index < data.glasses);
            });

            const counter = document.getElementById("water-count");
            if (counter) {
                counter.textContent = data.glasses;
            }

        })
        .catch(error => {
            console.error("Erro ao atualizar água:", error);
        });

}

document.querySelectorAll('form.inline').forEach(form => {
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Impede o envio tradicional do formulário

        const formData = new FormData(form); // Cria um objeto FormData com os dados do formulário

        fetch(form.action, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Atualize a interface (remova o item da lista, por exemplo)
                    form.closest('li').remove(); // Remove o item da lista
                } else {
                    alert('Erro ao remover o alimento');
                }
            })
            .catch(error => {
                console.error('Erro ao fazer a requisição:', error);
                alert('Erro ao tentar remover o alimento');
            });
    });
});

function getRandomTip() {
    const tips = [
        'Beba água antes das refeições para ajudar na saciedade.',
        'Inclua proteínas em todas as refeições para manter a energia.',
        'Vegetais coloridos são ricos em diferentes nutrientes.',
        'Mastigue bem os alimentos para melhor digestão.',
        'Evite distrações durante as refeições.',
        'Prepare suas refeições com antecedência.',
        'Faça pequenos lanches saudáveis entre as refeições principais.',
        'Durma bem! O sono afeta o metabolismo e a fome.',
        'Coma porções menores e mais frequentes durante o dia.',
        'Evite alimentos processados e ricos em açúcares refinados.',
        'Escolha carboidratos integrais em vez de refinados.',
        'Inclua fontes de gordura saudável, como abacate e nozes.',
        'Evite bebidas açucaradas, opte por água ou chá sem açúcar.',
        'Faça exercícios físicos regularmente para melhorar sua saúde.',
        'Não pule o café da manhã, ele é fundamental para o metabolismo.',
        'Coma devagar e preste atenção ao sabor dos alimentos.',
        'Aumente a ingestão de fibras para melhorar a digestão.',
        'Limite o consumo de sal para evitar retenção de líquidos.',
        'Priorize alimentos frescos e naturais em sua dieta.',
        'Coma uma variedade de alimentos para garantir uma nutrição equilibrada.',
        'Evite comer tarde da noite para evitar desconforto digestivo.',
        'Inclua alimentos ricos em antioxidantes para melhorar a saúde celular.',
        'Tenha uma alimentação equilibrada com todos os grupos alimentares.',
        'Aumente a ingestão de frutas e vegetais todos os dias.',
        'Faça da água sua principal bebida ao longo do dia.',
        'Reduza o consumo de carnes vermelhas e prefira fontes vegetais de proteína.',
        'Opte por snacks saudáveis como frutas, castanhas e iogurte.',
        'Alimente-se com calma, para sentir-se satisfeito e evitar excessos.',
        'Evite comer em frente à TV ou ao computador para não perder o controle da alimentação.',
        'Planeje suas refeições para evitar escolhas alimentares impulsivas.',
        'Adicione mais legumes nas suas refeições diárias.',
        'Faça refeições balanceadas e evite dietas extremamente restritivas.',
        'Use temperos naturais, como ervas frescas e especiarias, para dar sabor aos alimentos.',
        'Inclua alimentos ricos em ferro, como feijão e espinafre, para combater a anemia.',
        'Evite dietas milagrosas e procure um plano alimentar sustentável.',
        'Reduza o consumo de alimentos fritos e prefira alimentos assados ou grelhados.',
        'Opte por opções de sobremesas mais saudáveis, como frutas frescas.',
        'Faça alongamentos diariamente para melhorar a flexibilidade e reduzir o estresse.',
        'Estabeleça metas realistas e saudáveis para sua alimentação.',
        'Mantenha um diário alimentar para monitorar o que você come.',
        'Aumente a ingestão de probióticos para melhorar a saúde intestinal.',
        'Coma alimentos ricos em magnésio, como amêndoas e espinafre, para relaxamento muscular.',
        'Evite comer em excesso, mesmo que o alimento seja saudável.',
        'Escolha alimentos com baixo índice glicêmico para manter os níveis de energia estáveis.',
        'Não se prive dos alimentos que você gosta, apenas aprenda a equilibrá-los.',
        'Evite pular refeições, pois isso pode levar a compulsões alimentares.',
        'Coma alimentos ricos em vitamina C, como laranjas e morangos, para fortalecer o sistema imunológico.',
        'Evite dietas da moda que prometem resultados rápidos e prejudicam sua saúde.',
        'Mantenha-se hidratado durante o exercício físico para melhorar o desempenho.',
        'Priorize a alimentação de qualidade ao invés da quantidade.',
        'Inclua chás naturais, como chá verde e camomila, que têm propriedades antioxidantes.',
        'Limite o consumo de alimentos ricos em gorduras trans e saturadas.',
        'Coma com moderação e faça escolhas conscientes para manter uma alimentação saudável.'
    ];
    
    // Retorna uma dica aleatória
    return tips[Math.floor(Math.random() * tips.length)];
}

function removerAlimento(id) {
    let formData = new FormData();
    formData.append('id', id);

    fetch('/receitas/remover', { // Confirme se a URL está correta (refeicoes/remover ou receitas/remover)
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // A mágica acontece aqui: Recarrega a página atual!
            window.location.reload(); 
        } else {
            alert('Erro: ' + data.message);
        }
    })
    .catch(error => console.error('Erro:', error));
}
// ===== CONFIG =====
const WATER_GOAL = 2000;

// ===== ELEMENTOS =====
const el = {
    input: document.getElementById('water-input'),
    consumed: document.getElementById('water-consumed'),
    bar: document.getElementById('water-bar'),
    percentage: document.getElementById('water-percentage'),
    status: document.getElementById('water-status'),
    remaining: document.getElementById('water-remaining')
};

// ===== ESTADO =====
let currentMl = Number(localStorage.getItem('water_ml')) || 0;

// ===== HELPERS =====
function getStatus(p) {
    if (p >= 100) return '✅ Meta atingida!';
    if (p >= 75) return '🔥 Quase lá!';
    if (p >= 50) return 'Continua!';
    if (p >= 25) return 'Bom progresso!';
    return 'Beba mais!';
}

// ===== RENDER =====
function render() {
    const percentage = Math.min(100, (currentMl / WATER_GOAL) * 100);

    el.consumed.textContent = currentMl;
    el.percentage.textContent = Math.round(percentage);
    el.status.textContent = getStatus(percentage);
    el.remaining.textContent = Math.max(0, WATER_GOAL - currentMl);

    el.bar.style.width = percentage + '%';

    localStorage.setItem('water_ml', currentMl);
}

// ===== UPDATE =====
function updateWater(ml) {
    const prev = currentMl;
    currentMl += ml;

    if (currentMl > WATER_GOAL) {
        const allowed = WATER_GOAL - prev;

        if (allowed <= 0) {
            showToast('✅ Meta já atingida!');
            return;
        }

        currentMl = WATER_GOAL;
        showToast(`⚠️ Só mais ${allowed}ml permitido`);
    }

    render();

    // efeito meta
    if (prev < WATER_GOAL && currentMl >= WATER_GOAL) {
        el.bar.classList.add('animate-pulse');
        showToast('🎉 Meta atingida!');
        triggerConfetti();

        setTimeout(() => {
            el.bar.classList.remove('animate-pulse');
        }, 2000);
    }

    // sync
    fetch('/dashboard/updateWater', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ water_ml: currentMl })
    }).catch(() => showToast('❌ Erro ao salvar'));
}

// ===== AÇÕES =====
function addWater() {
    const ml = Number(el.input.value);

    if (isNaN(ml) || ml <= 0) {
        showToast('❌ Valor inválido');
        return;
    }

    updateWater(ml);
    el.input.value = '';
}

function addWaterQuick(ml) {
    updateWater(ml);
}

function resetWater() {
    if (!confirm('Resetar água?')) return;

    currentMl = 0;
    render();
    showToast('🗑️ Resetado');

    fetch('/dashboard/updateWater', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ water_ml: 0 })
    });
}

// ===== INIT =====
render();

// ===== EFEITO =====
function triggerConfetti() {
    el.bar.style.boxShadow = '0 0 25px rgba(34,197,94,0.9)';
    setTimeout(() => el.bar.style.boxShadow = 'none', 2000);
}