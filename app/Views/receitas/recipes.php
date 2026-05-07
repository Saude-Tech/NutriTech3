<div class="p-4 pb-24 space-y-6 animate-fade-in">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Receitas Saudáveis</h2>
        <p class="text-gray-500">Encontre receitas nutritivas e deliciosas</p>
    </div>

    <div class="relative">
        <input type="text" id="recipe-search" placeholder="Buscar receitas..."
            class="w-full pl-10 pr-4 py-3 bg-white rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary/50"
            onkeyup="filterRecipes(this.value)">
        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>

    <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide">
        <button class="category-btn bg-primary text-white whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition-all"
            onclick="filterByCategory('all', this)">🍽️ Todas</button>

        <button class="category-btn bg-gray-100 text-gray-600 whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition-all"
            onclick="filterByCategory('cafe', this)">☀️ Café da Manhã</button>

        <button class="category-btn bg-gray-100 text-gray-600 whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition-all"
            onclick="filterByCategory('almoco', this)">🥗 Almoço</button>

        <button class="category-btn bg-gray-100 text-gray-600 whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition-all"
            onclick="filterByCategory('jantar', this)">🌙 Jantar</button>

        <button class="category-btn bg-gray-100 text-gray-600 whitespace-nowrap px-4 py-2 rounded-full text-sm font-medium transition-all"
            onclick="filterByCategory('lanche', this)">🍎 Lanches</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="recipes-grid">
        <?= view('includes/card_receitas', ['recipes' => $recipes]) ?>
    </div>
</div>

<!-- Modal antigo mantido, caso alguma parte do projeto use ele -->
<div id="recipe-detail-modal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-lg max-h-[90vh] overflow-hidden animate-slide-up">
        <div id="recipe-detail-content"></div>
    </div>
</div>

<!-- Recipe Modal -->
<div id="recipe-modal" class="modal-overlay hidden">
    <div class="modal-content">

        <button onclick="closeRecipeModal()" class="modal-close">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="modal-image-container">
            <img id="modal-image" src="" alt="" class="modal-image">
            <div class="modal-category-badge" id="modal-category"></div>
        </div>

        <div class="modal-body">

            <h2 id="modal-title" class="modal-title"></h2>

            <!-- Cards do topo igual a imagem -->
            <div class="recipe-info-box">
                <div class="recipe-info-item">
                    <div class="difficulty-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <strong>DIFICULDADE</strong>
                    <p id="modal-difficulty">Fácil</p>
                </div>

                <div class="recipe-info-divider"></div>

                <div class="recipe-info-item">
                    <div class="recipe-icon">♨</div>
                    <strong>PORÇÕES</strong>
                    <p id="modal-portions">0</p>
                </div>

                <div class="recipe-info-divider"></div>

                <div class="recipe-info-item">
                    <div class="recipe-icon">⏱</div>
                    <strong>TOTAL</strong>
                    <p id="modal-total-time">0 min</p>
                </div>
            </div>

            <!-- Macros continuam existindo, mas com visual mais discreto -->
            <div id="modal-macros" class="modal-macros"></div>

            <div class="modal-section">
                <h3>Ingredientes</h3>
                <ul id="modal-ingredients" class="ingredients-list"></ul>
            </div>

            <div class="modal-section">
                <h3>Modo de Preparo</h3>
                <p id="modal-instructions" class="instructions-text"></p>
            </div>

            <div class="modal-section quantity-section">
                <h3>Quantidade de porções</h3>
                <input 
                    type="number" 
                    id="modal-quantity" 
                    class="input-field" 
                    placeholder="Digite a quantidade"
                    min="1"
                >
            </div>

            <input type="hidden" id="modal-recipe-id" value="">
            <input type="hidden" id="modal-recipe-category" value="">

            <button class="modal-add-btn" onclick="addToDaily()">
                + Adicionar ao Diário
            </button>
        </div>
    </div>
</div>

<script src="recipes.js"></script>

<script>
    let termoPesquisa = "";
    let categoriaAtual = "all";

    async function abrirModalReceita(receitaId) {
        try {
            document.getElementById('recipe-modal').classList.remove('hidden');

            const response = await fetch(`<?= base_url('receitas/detalhes/') ?>${receitaId}`);
            const data = await response.json();

            if (data.erro) {
                alert(data.erro);
                return;
            }

            document.getElementById('modal-title').innerText = data.nome;
            document.getElementById('modal-category').innerText = data.categoria;
            document.getElementById('modal-image').src = `<?= base_url('assets/img/recipes/') ?>${data.imagem}`;
            document.getElementById('modal-recipe-id').value = receitaId;
            document.getElementById('modal-recipe-category').value = data.categoria;

            document.getElementById('modal-portions').innerText = data.porcoes ?? 0;
            document.getElementById('modal-total-time').innerText = `${data.tempo_preparo ?? 0} min`;
            document.getElementById('modal-difficulty').innerText = data.dificuldade ?? 'Fácil';

            document.getElementById('modal-macros').innerHTML = `
                <span class="macro-badge">🔥 ${data.calorias} kcal</span>
                <span class="macro-badge">🥩 ${data.proteinas}g Prot</span>
                <span class="macro-badge">🍞 ${data.carboidratos}g Carb</span>
                <span class="macro-badge">🥑 ${data.gordura}g Gord</span>
            `;

            const listaIngredientes = document.getElementById('modal-ingredients');
            listaIngredientes.innerHTML = '';

            if (data.lista_ingredientes && data.lista_ingredientes.length > 0) {
                data.lista_ingredientes.forEach(ing => {
                    const li = document.createElement('li');

                    const quantidade = ing.quantidade ?? '';
                    const unidade = ing.unidade ?? '';
                    const alimento = ing.alimento ?? '';

                    li.innerText = `${quantidade} ${unidade} de ${alimento}`.trim();
                    listaIngredientes.appendChild(li);
                });
            }

            document.getElementById('modal-instructions').innerText = formatarModoPreparo(data.descricao);

            const addBtn = document.querySelector('.modal-add-btn');
            addBtn.setAttribute('onclick', `addToDaily(${data.id})`);

        } catch (error) {
            console.error("Erro ao buscar a receita:", error);
        }
    }

    function formatarModoPreparo(texto) {
        if (!texto) return '';

        let textoFormatado = texto.trim();

        textoFormatado = textoFormatado
            .replace(/(\d+\.)/g, '\n$1')
            .replace(/^\n/, '');

        return textoFormatado;
    }

    function closeRecipeModal() {
        document.getElementById('recipe-modal').classList.add('hidden');
    }

    function filterRecipes(valor) {
        termoPesquisa = valor;
        atualizarCards();
    }

    function filterByCategory(categoria, botaoClicado) {
        categoriaAtual = categoria;

        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('bg-primary', 'text-white');
            btn.classList.add('bg-gray-100', 'text-gray-600');
        });

        botaoClicado.classList.remove('bg-gray-100', 'text-gray-600');
        botaoClicado.classList.add('bg-primary', 'text-white');

        atualizarCards();
    }

    async function atualizarCards() {
        try {
            const url = `<?= base_url('receitas/filtrar') ?>?categoria=${categoriaAtual}&busca=${termoPesquisa}`;

            const response = await fetch(url);
            const htmlRetornado = await response.text();

            document.getElementById('recipes-grid').innerHTML = htmlRetornado;
        } catch (error) {
            console.error("Erro ao atualizar:", error);
        }
    }
</script>