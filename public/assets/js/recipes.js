
function addToDaily() {
    // Pegamos o ID da receita que deve estar guardado em algum lugar do modal
    const receitaId = document.getElementById('modal-recipe-id').value;
    const tipoRefeicao = document.getElementById('modal-recipe-category').value; // Você pode pegar isso de um <select> no modal

    fetch('/receitas/adicionar', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
        body: JSON.stringify({
            receita_id: receitaId,
            tipo_refeicao: tipoRefeicao
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('recipe-modal').classList.add('hidden');
                mostrarModalSucesso(data.message);
            }    
        });
}

function mostrarModalSucesso(mensagem) {
    // Garante que não tenha modais duplicados na tela
    const modalAntigo = document.getElementById('modal-sucesso-dinamico');
    if (modalAntigo) modalAntigo.remove();

    // Cria o HTML do modal com Tailwind
    const htmlModal = `
        <div id="modal-sucesso-dinamico" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 transition-opacity duration-300 opacity-0">
            <div class="bg-white rounded-2xl shadow-2xl p-6 max-w-sm w-full mx-4 transform transition-all duration-300 scale-100 text-center">
                
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                
                <h3 class="text-lg font-bold text-gray-900 mb-2">Sucesso!</h3>
                <p class="text-gray-600">${mensagem}</p>
                
                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-6 overflow-hidden">
                    <div class="bg-green-500 h-1.5 rounded-full animate-shrink-bar" style="width: 100%;"></div>
                </div>
            </div>
        </div>

        <style>
            @keyframes shrink-bar {
                from { width: 100%; }
                to { width: 0%; }
            }
            .animate-shrink-bar {
                animation: shrink-bar 5s linear forwards;
            }
        </style>
    `;

    // Injeta o modal no final do <body>
    document.body.insertAdjacentHTML('beforeend', htmlModal);
    const modal = document.getElementById('modal-sucesso-dinamico');

    // Um pequeno truque (delay de 10ms) para a animação de Fade-In funcionar
    setTimeout(() => {
        modal.classList.remove('opacity-0');
    }, 10);

    // Começa a contar os 5 segundos...
    setTimeout(() => {
        // Efeito de Fade-Out (ficar invisível)
        modal.classList.add('opacity-0');
        
        // Espera a animação acabar (300ms) para apagar do HTML
        setTimeout(() => {
            modal.remove();
        }, 300);
    }, 3000);
}