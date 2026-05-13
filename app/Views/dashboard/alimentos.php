<div class="nt-page">

    <main class="nt-main">

        <div class="nt-page-title">
            <div>
                <h2>Adicionar Alimento</h2>
                <p>Encontre e adicione alimentos à sua refeição</p>
            </div>

            <a href="<?= base_url('dashboard') ?>" class="nt-back-btn">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Voltar
            </a>
        </div>

        <div class="nt-search-wrap">
            <svg class="nt-search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>

            <input type="text" id="food-search" placeholder="Buscar alimento...">

            <button class="nt-search-clear" id="search-clear" title="Limpar">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="nt-section-title">🍎 Mais usados</div>

        <div class="nt-food-grid" id="food-grid">
            <?php
            $emojis = ['🥚', '🍗', '🍚', '🌾', '🫐', '🍌', '🍎', '🥛', '🥦', '🥩', '🐟', '🧀', '🥜', '🫒', '🍠', '🫘'];
            $i = 0;

            foreach ($alimentos as $alimento):
                $emoji = $emojis[$i % count($emojis)];
                $i++;
                ?>

                <div class="food-item" data-name="<?= strtolower(htmlspecialchars($alimento['nome'])) ?>">

                    <span class="food-item-emoji"><?= $emoji ?></span>

                    <h3><?= htmlspecialchars($alimento['nome']) ?></h3>

                    <div class="food-item-kcal"><?= $alimento['calorias'] ?> kcal</div>

                    <div class="food-item-unit">
                        P:<?= $alimento['proteinas'] ?>g · C:<?= $alimento['carboidratos'] ?>g ·
                        G:<?= $alimento['gorduras'] ?>g
                    </div>

                    <button type="button" class="btn-selecionar" onclick="toggleForm(this)">
                        Selecionar
                    </button>

                    <form action="<?= base_url('dashboard/adicionarAlimento') ?>" method="post" class="food-item-form">
                        <input type="hidden" name="alimento_id" value="<?= $alimento['id'] ?>">

                        <div>
                            <label>Quantidade</label>
                            <input type="number" name="quantidade" value="1" step="0.01" min="0" required>
                        </div>

                        <div>
                            <label>Unidade</label>
                            <select name="unidade_id">
                                <?php foreach ($unidades as $unidade): ?>
                                    <option value="<?= $unidade['id'] ?>" <?= $unidade['id'] == 1 ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($unidade['nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn-add">Adicionar ✓</button>
                    </form>

                </div>

            <?php endforeach; ?>
        </div>

        <div class="nt-ver-todos">
            <button id="btn-ver-todos" onclick="toggleVerTodos(this)">
                Ver todos os alimentos
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>

        <div class="nt-tip">
            💡 <strong>Dica do dia:</strong>&nbsp; Pequenas escolhas hoje, grandes conquistas amanhã!
        </div>

    </main>

    <aside class="nt-sidebar">

        <div class="nt-summary-card" id="summary-card">

            <button type="button" class="summary-close-btn" onclick="closeSummaryModal()" title="Fechar">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div id="summary-empty">
                <h3>
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6h13M10 19a1 1 0 100 2 1 1 0 000-2zm7 0a1 1 0 100 2 1 1 0 000-2z" />
                    </svg>
                    Resumo da seleção
                </h3>

                <div class="nt-empty-state">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6h13M10 19a1 1 0 100 2 1 1 0 000-2zm7 0a1 1 0 100 2 1 1 0 000-2z" />
                    </svg>

                    <p>Nenhum alimento selecionado</p>
                    <span>Escolha um alimento e defina a quantidade para ver o resumo aqui.</span>
                </div>
            </div>

            <div id="summary-content" style="display:none;">

                <div class="summary-top">
                    <div class="summary-food">
                        <div class="summary-emoji" id="summary-emoji">🥚</div>

                        <div>
                            <h4 id="summary-name">Ovo</h4>
                            <span id="summary-kcal-unit">155 kcal por unidade</span>
                        </div>
                    </div>

                    <span class="summary-badge">✔ Fonte de proteína</span>
                </div>

                <div class="summary-quantity">
                    <label>Quantidade</label>

                    <div class="summary-qty-box">
                        <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>

                        <input type="number" id="summary-qty" value="1" min="1" step="1">

                        <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>

                        <select id="summary-unit">
                            <?php foreach ($unidades as $unidade): ?>
                                <option value="<?= $unidade['id'] ?>">
                                    <?= htmlspecialchars($unidade['nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <select id="summary-meal">
                            <option value="cafe">Café da manhã</option>
                            <option value="almoco">Almoço</option>
                            <option value="jantar">Jantar</option>
                            <option value="lanche">Lanche</option>
                        </select>
                    </div>
                </div>

                <div class="summary-macros">

                    <div class="macro-box">
                        <span>Calorias</span>
                        <strong id="macro-kcal">0 kcal</strong>
                    </div>

                    <div class="macro-box">
                        <span>Proteína</span>
                        <strong id="macro-protein">0 g</strong>
                    </div>

                    <div class="macro-box">
                        <span>Carbo</span>
                        <strong id="macro-carb">0 g</strong>
                    </div>

                    <div class="macro-box">
                        <span>Gordura</span>
                        <strong id="macro-fat">0 g</strong>
                    </div>

                </div>

                <form action="<?= base_url('dashboard/adicionarAlimento') ?>" method="post" id="summary-form">

                    <input type="hidden" name="alimento_id" id="summary-food-id">
                    <input type="hidden" name="quantidade" id="summary-hidden-qty">
                    <input type="hidden" name="unidade_id" id="summary-hidden-unit">
                    <input type="hidden" name="tipo_refeicao" class="list-hidden-meal" id="summary-hidden-meal">


                    <button type="submit" class="summary-submit">
                        Adicionar à refeição
                    </button>

                </form>

            </div>

        </div>

    </aside>

</div>

<div id="toast">
    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" id="toast-icon">
        <path fill-rule="evenodd"
            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
            clip-rule="evenodd" />
    </svg>
    <span id="toast-message"></span>
</div>

<script>
    function showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        document.getElementById('toast-message').textContent = message;

        toast.className = type === 'error' ? 'show error' : 'show';

        clearTimeout(toast._timer);

        toast._timer = setTimeout(() => {
            toast.className = '';
        }, 3200);
    }

    const searchInput = document.getElementById('food-search');
    const clearBtn = document.getElementById('search-clear');

    searchInput.addEventListener('input', function () {
        const q = this.value.toLowerCase().trim();

        clearBtn.style.display = q ? 'block' : 'none';

        document.querySelectorAll('.food-item').forEach(item => {
            item.style.display = item.dataset.name.includes(q) ? '' : 'none';
        });
    });

    clearBtn.addEventListener('click', function () {
        searchInput.value = '';
        clearBtn.style.display = 'none';

        document.querySelectorAll('.food-item').forEach(item => {
            item.style.display = '';
        });

        searchInput.focus();
    });

    const INITIAL_SHOW = 8;
    const allCards = document.querySelectorAll('.food-item');
    let expanded = false;

    function applyLimit() {
        allCards.forEach((card, index) => {
            if (!expanded && index >= INITIAL_SHOW) {
                card.style.display = 'none';
            } else {
                card.style.display = '';
            }
        });
    }

    applyLimit();

    function toggleVerTodos(btn) {
        expanded = !expanded;

        applyLimit();

        btn.classList.toggle('open', expanded);
        btn.childNodes[0].textContent = expanded ? 'Ver menos ' : 'Ver todos os alimentos ';
    }

    window.onload = function () {
        <?php if (session()->getFlashdata('success')): ?>
            showToast('<?= session()->getFlashdata('success') ?>', 'success');
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            showToast('<?= session()->getFlashdata('error') ?>', 'error');
        <?php endif; ?>
    };

    let currentFood = null;

    function toggleForm(btn) {
        document.querySelectorAll('.btn-selecionar').forEach(button => {
            button.classList.remove('active');
            button.textContent = 'Selecionar';
        });

        btn.classList.add('active');
        btn.textContent = 'Selecionado';

        const card = btn.closest('.food-item');

        const foodId = card.querySelector('input[name="alimento_id"]').value;
        const foodName = card.querySelector('h3').textContent;
        const foodEmoji = card.querySelector('.food-item-emoji').textContent;

        const kcal = parseFloat(card.querySelector('.food-item-kcal').textContent);

        const unitText = card.querySelector('.food-item-unit').textContent;

        const proteins = parseFloat(unitText.match(/P:(.*?)g/)[1]);
        const carbs = parseFloat(unitText.match(/C:(.*?)g/)[1]);
        const fats = parseFloat(unitText.match(/G:(.*?)g/)[1]);

        currentFood = {
            id: foodId,
            name: foodName,
            emoji: foodEmoji,
            kcal: kcal,
            proteins: proteins,
            carbs: carbs,
            fats: fats
        };

        document.getElementById('summary-empty').style.display = 'none';
        document.getElementById('summary-content').style.display = 'block';

        document.getElementById('summary-food-id').value = foodId;

        document.getElementById('summary-name').textContent = foodName;
        document.getElementById('summary-emoji').textContent = foodEmoji;
        document.getElementById('summary-kcal-unit').textContent = `${kcal} kcal por unidade`;

        document.getElementById('summary-qty').value = 1;

        updateSummaryMacros();
    }

    function updateSummaryMacros() {
        if (!currentFood) return;

        const qty = parseFloat(document.getElementById('summary-qty').value) || 1;

        const kcal = currentFood.kcal * qty;
        const protein = currentFood.proteins * qty;
        const carb = currentFood.carbs * qty;
        const fat = currentFood.fats * qty;

        document.getElementById('macro-kcal').textContent = kcal.toFixed(0) + ' kcal';
        document.getElementById('macro-protein').textContent = protein.toFixed(1) + ' g';
        document.getElementById('macro-carb').textContent = carb.toFixed(1) + ' g';
        document.getElementById('macro-fat').textContent = fat.toFixed(1) + ' g';

        document.getElementById('summary-hidden-qty').value = qty;
        document.getElementById('summary-hidden-unit').value = document.getElementById('summary-unit').value;
        document.getElementById('summary-hidden-meal').value = document.getElementById('summary-meal').value;
    }

    function changeQty(amount) {
        const input = document.getElementById('summary-qty');

        let value = parseInt(input.value) || 1;

        value += amount;

        if (value < 1) {
            value = 1;
        }

        input.value = value;

        updateSummaryMacros();
    }

    function closeSummaryModal() {
        document.getElementById('summary-empty').style.display = 'block';
        document.getElementById('summary-content').style.display = 'none';

        currentFood = null;

        document.querySelectorAll('.btn-selecionar').forEach(btn => {
            btn.classList.remove('active');
            btn.textContent = 'Selecionar';
        });
    }

    document.getElementById('summary-meal').addEventListener('change', function () {
        const refeicaoSelecionada = this.value;

        // Atualiza a barra lateral
        updateSummaryMacros();

        // Atualiza todos os formulários pequenos da lista
        document.querySelectorAll('.list-hidden-meal').forEach(input => {
            input.value = refeicaoSelecionada;
        });
    });

    document.getElementById('summary-form').addEventListener('submit', function () {
        document.getElementById('summary-hidden-meal').value = document.getElementById('summary-meal').value;
        document.getElementById('summary-hidden-qty').value = document.getElementById('summary-qty').value;
        document.getElementById('summary-hidden-unit').value = document.getElementById('summary-unit').value;
    });

    document.getElementById('summary-qty').addEventListener('input', updateSummaryMacros);
    document.getElementById('summary-unit').addEventListener('change', updateSummaryMacros);
    document.getElementById('summary-meal').addEventListener('change', updateSummaryMacros);
</script>