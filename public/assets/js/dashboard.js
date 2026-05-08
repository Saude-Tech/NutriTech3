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
let currentMl = (typeof waterInitial !== 'undefined' ? waterInitial : 0) || Number(localStorage.getItem('water_ml')) || 0;

// ===== HELPERS =====
function getStatus(p) {
    if (p >= 100) return '';
    if (p >= 75) return '';
    if (p >= 50) return '';
    if (p >= 25) return '';
    return '';
}

// ===== RENDER =====
function render() {
    const percentage = Math.min(100, (currentMl / WATER_GOAL) * 100);

    el.consumed.textContent = currentMl;
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

// ===== FUNÇÕES UTILITÁRIAS =====
function showCustomWaterInput() {
    const row = document.getElementById('custom-water-row');
    if (row) row.classList.toggle('hidden');
}

// ===== ATUALIZAÇÃO EM TEMPO REAL =====
function updateDashboardStats(stats) {
    if (!stats) return;

    // Atualizar calorias
    const caloriasEl = document.getElementById('water-consumed');
    if (caloriasEl) {
        // Encontrar o elemento de calorias consumidas
        const caloriesElements = document.querySelectorAll('[id="water-consumed"]');
        // Procurar por elemento de calorias no HTML
        const mainContent = document.getElementById('main-content');
        if (mainContent) {
            const calorieValue = mainContent.querySelector('p[style*="color:#22c55e"]');
            if (calorieValue && stats.calorias !== undefined) {
                calorieValue.textContent = formatarNumero(stats.calorias) + ' kcal';
            }
        }
    }

    // Atualizar porcentagem e barra de progresso
    if (stats.percentual !== undefined) {
        const percentEl = document.querySelector('.progress-ring + div span:first-child');
        if (percentEl) {
            percentEl.textContent = Math.min(100, stats.percentual) + '%';
        }

        // Atualizar SVG do ring (stroke-dashoffset)
        const circumference = 2 * Math.PI * 52;
        const offset = circumference * (1 - (Math.min(100, stats.percentual) / 100));
        const circle = document.querySelector('.progress-ring__circle');
        if (circle) {
            circle.style.strokeDashoffset = offset;
        }
    }

    // Atualizar macros
    if (stats.macros) {
        updateMacroCard('protein', stats.macros.proteinas || 0, stats.goals?.proteinas || 150);
        updateMacroCard('carbs', stats.macros.carboidratos || 0, stats.goals?.carboidratos || 150);
        updateMacroCard('fat', stats.macros.gorduras || 0, stats.goals?.gorduras || 50);
    }
}

function formatarNumero(num) {
    if (typeof num !== 'number') num = parseFloat(num);
    return num.toLocaleString('pt-BR', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
}

function updateMacroCard(type, current, goal) {
    // Encontrar o card do macro correspondente
    const cards = document.querySelectorAll('.bg-white.rounded-xl.p-4.shadow-sm');
    let targetCard = null;

    if (type === 'protein') {
        targetCard = Array.from(cards).find(c => c.textContent.includes('Proteína'));
    } else if (type === 'carbs') {
        targetCard = Array.from(cards).find(c => c.textContent.includes('Carbos'));
    } else if (type === 'fat') {
        targetCard = Array.from(cards).find(c => c.textContent.includes('Gordura'));
    }

    if (targetCard) {
        const valueEl = targetCard.querySelector('p.text-xl.font-bold');
        if (valueEl) {
            valueEl.textContent = Math.round(current) + 'g';
        }

        const barEl = targetCard.querySelector('.macro-bar');
        if (barEl) {
            const percentage = Math.min(100, (current / goal) * 100);
            barEl.style.width = percentage + '%';
        }
    }
}

// Função para recarregar o dashboard com dados atualizados
function reloadDashboardData() {
    fetch(BASE_URL + 'dashboard', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then(response => response.text())
        .then(html => {
            // Parse HTML e extrai conteúdo
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            // Recarregar apenas os elementos necessários
            const mainContent = document.getElementById('main-content');
            const newMainContent = doc.getElementById('main-content');
            
            if (mainContent && newMainContent) {
                mainContent.innerHTML = newMainContent.innerHTML;
                
                // Reinicializar variáveis globais baseadas no DOM
                if (document.getElementById('water-consumed')) {
                    // Recalcular água (se houver)
                    const waterText = document.getElementById('water-consumed').textContent;
                    const waterValue = parseInt(waterText) || 0;
                    currentMl = waterValue;
                    render();
                }
                
                // Reinicializar event listeners do forms de alimentos
                initDashboardListeners();
                
                // Mostrar feedback visual
                mainContent.style.opacity = '0.9';
                setTimeout(() => {
                    mainContent.style.opacity = '1';
                }, 100);
            }
        })
        .catch(error => {
            console.error('Erro ao recarregar:', error);
            showToast('❌ Erro ao recarregar dados', 'error');
        });
}

function initDashboardListeners() {
    // Reinicializar listeners de forms se necessário
    document.querySelectorAll('form.inline').forEach(form => {
        if (!form._listenerAdded) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(form);
                fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            reloadDashboardData();
                            showToast('✅ Alimento removido', 'success');
                        } else {
                            showToast('❌ ' + (data.message || 'Erro ao remover'), 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        showToast('❌ Erro na requisição', 'error');
                    });
            });
            form._listenerAdded = true;
        }
    });
}

// Inicializar listeners quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', function() {
    initDashboardListeners();
});