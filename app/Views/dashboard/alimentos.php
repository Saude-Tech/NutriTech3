<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap');

    :root {
        --primary: #2D9B4E;
        --primary-light: #E8F5ED;
        --primary-dark: #1e7a3b;
        --text-dark: #1a1a2e;
        --text-mid: #4a5568;
        --text-light: #9ca3af;
        --bg: #f5f7f5;
        --card: #ffffff;
        --border: #e8ede9;
        --warn-bg: #fffbeb;
        --warn-border: #fde68a;
        --warn-text: #92400e;
        --header-bg: #1a1a2e;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: 'DM Sans', sans-serif;
        background: var(--bg);
        color: var(--text-dark);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* ── Header ─────────────────────────────── */
    .nt-header {
        background: var(--header-bg);
        padding: 12px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 100;
    }
    .nt-logo {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .nt-logo-icon {
        width: 36px;
        height: 36px;
        background: var(--primary);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    .nt-logo-text h1 {
        color: #fff;
        font-size: 15px;
        font-weight: 700;
        line-height: 1.1;
    }
    .nt-logo-text p {
        color: #9ca3af;
        font-size: 11px;
        text-transform: capitalize;
    }
    .nt-header-right {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .nt-bell {
        position: relative;
        cursor: pointer;
    }
    .nt-bell svg { color: #d1d5db; width: 22px; height: 22px; }
    .nt-bell-dot {
        position: absolute;
        top: 0; right: 0;
        width: 7px; height: 7px;
        background: #ef4444;
        border-radius: 50%;
        border: 2px solid var(--header-bg);
    }
    .nt-avatar {
        width: 34px; height: 34px;
        background: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
    }

    /* ── Layout ──────────────────────────────── */
    .nt-page {
        flex: 1;
        max-width: 1200px;
        margin: 0 auto;
        width: 100%;
        padding: 28px 24px 100px;
        display: grid;
        grid-template-columns: 1fr 320px;
        grid-template-rows: auto;
        gap: 24px;
        align-items: start;
    }
    .nt-main { min-width: 0; }
    .nt-sidebar { position: sticky; top: 80px; }

    /* ── Page Title ──────────────────────────── */
    .nt-page-title {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    .nt-page-title h2 {
        font-size: 22px;
        font-weight: 700;
        color: var(--text-dark);
    }
    .nt-page-title p {
        font-size: 13px;
        color: var(--text-light);
        margin-top: 2px;
    }
    .nt-back-btn {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 10px;
        color: var(--text-mid);
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        transition: background .2s;
        white-space: nowrap;
    }
    .nt-back-btn:hover { background: #f0f0f0; }

    /* ── Search ──────────────────────────────── */
    .nt-search-wrap {
        position: relative;
        margin-bottom: 24px;
    }
    .nt-search-wrap input {
        width: 100%;
        padding: 13px 44px 13px 42px;
        border: 1.5px solid var(--border);
        border-radius: 14px;
        background: var(--card);
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        color: var(--text-dark);
        transition: border-color .2s, box-shadow .2s;
        outline: none;
    }
    .nt-search-wrap input::placeholder { color: var(--text-light); }
    .nt-search-wrap input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(45,155,78,.1);
    }
    .nt-search-icon {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px; height: 18px;
        color: var(--text-light);
    }
    .nt-search-clear {
        position: absolute;
        right: 13px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: var(--text-light);
        padding: 2px;
        display: none;
    }
    .nt-search-clear:hover { color: var(--text-dark); }

    /* ── Section Header ──────────────────────── */
    .nt-section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 15px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 14px;
    }

    /* ── Food Grid ───────────────────────────── */
    .nt-food-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-bottom: 16px;
    }

    /* ── Food Card ───────────────────────────── */
    .food-item {
        background: var(--card);
        border: 1.5px solid var(--border);
        border-radius: 16px;
        padding: 16px 14px 14px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        transition: border-color .2s, box-shadow .2s, transform .15s;
        cursor: default;
    }
    .food-item:hover {
        border-color: var(--primary);
        box-shadow: 0 4px 20px rgba(45,155,78,.12);
        transform: translateY(-2px);
    }

    .food-item-emoji {
        font-size: 42px;
        margin-bottom: 8px;
        line-height: 1;
        display: block;
    }

    .food-item h3 {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 4px;
    }

    .food-item-kcal {
        font-size: 14px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 1px;
    }

    .food-item-unit {
        font-size: 11px;
        color: var(--text-light);
        margin-bottom: 12px;
    }

    /* Selecionar toggle button */
    .food-item .btn-selecionar {
        width: 100%;
        padding: 7px 10px;
        border: 1.5px solid var(--primary);
        border-radius: 8px;
        background: transparent;
        color: var(--primary);
        font-family: 'DM Sans', sans-serif;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s, color .2s;
    }
    .food-item .btn-selecionar:hover,
    .food-item .btn-selecionar.active {
        background: var(--primary);
        color: #fff;
    }

    /* Inline form (shown after Selecionar) */
    .food-item-form {
        width: 100%;
        margin-top: 10px;
        display: none;
        flex-direction: column;
        gap: 7px;
        text-align: left;
    }
    .food-item-form.visible { display: flex; }
    .food-item-form label {
        font-size: 11px;
        font-weight: 600;
        color: var(--text-mid);
        margin-bottom: 2px;
        display: block;
    }
    .food-item-form input,
    .food-item-form select {
        width: 100%;
        padding: 7px 10px;
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-size: 12px;
        color: var(--text-dark);
        background: var(--bg);
        outline: none;
        transition: border-color .2s;
    }
    .food-item-form input:focus,
    .food-item-form select:focus {
        border-color: var(--primary);
    }
    .food-item-form .btn-add {
        width: 100%;
        padding: 8px;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: background .2s;
        margin-top: 2px;
    }
    .food-item-form .btn-add:hover { background: var(--primary-dark); }

    /* ── Ver todos ───────────────────────────── */
    .nt-ver-todos {
        text-align: center;
        margin-bottom: 20px;
    }
    .nt-ver-todos button {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 20px;
        background: var(--card);
        border: 1.5px solid var(--border);
        border-radius: 10px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-mid);
        cursor: pointer;
        transition: border-color .2s, color .2s;
    }
    .nt-ver-todos button:hover {
        border-color: var(--primary);
        color: var(--primary);
    }
    .nt-ver-todos button svg {
        width: 15px;
        height: 15px;
        transition: transform .3s;
    }
    .nt-ver-todos button.open svg { transform: rotate(180deg); }

    /* ── Tip bar ─────────────────────────────── */
    .nt-tip {
        background: var(--warn-bg);
        border: 1.5px solid var(--warn-border);
        border-radius: 12px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: var(--warn-text);
        font-weight: 500;
    }

    /* ── Sidebar ─────────────────────────────── */
    .nt-summary-card {
        background: var(--card);
        border: 1.5px solid var(--border);
        border-radius: 16px;
        padding: 18px;
        margin-bottom: 14px;
    }
    .nt-summary-card h3 {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 16px;
    }
    .nt-summary-card h3 svg { color: var(--primary); }
    .nt-empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 12px 0 8px;
        gap: 8px;
    }
    .nt-empty-state svg { color: #d1d5db; width: 40px; height: 40px; }
    .nt-empty-state p { font-size: 13px; color: var(--text-mid); font-weight: 600; }
    .nt-empty-state span { font-size: 12px; color: var(--text-light); line-height: 1.4; }

    .nt-info-card {
        background: var(--primary-light);
        border: 1.5px solid #b7dfbf;
        border-radius: 12px;
        padding: 14px 16px;
    }
    .nt-info-card h4 {
        font-size: 13px;
        font-weight: 700;
        color: var(--primary-dark);
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 6px;
    }
    .nt-info-card p {
        font-size: 12px;
        color: #2d6e43;
        line-height: 1.5;
    }

    /* ── Bottom Nav ──────────────────────────── */
    .nt-bottom-nav {
        position: fixed;
        bottom: 0; left: 0; right: 0;
        background: var(--card);
        border-top: 1.5px solid var(--border);
        display: flex;
        justify-content: space-around;
        padding: 10px 0 14px;
        z-index: 100;
    }
    .nt-nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        text-decoration: none;
        color: var(--text-light);
        font-size: 11px;
        font-weight: 500;
        transition: color .2s;
        min-width: 64px;
    }
    .nt-nav-item svg { width: 22px; height: 22px; }
    .nt-nav-item.active { color: var(--primary); }

    /* ── Toast ───────────────────────────────── */
    #toast {
        position: fixed;
        top: 72px;
        left: 50%;
        transform: translateX(-50%) translateY(-8px);
        background: var(--header-bg);
        color: #fff;
        padding: 12px 22px;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0,0,0,.2);
        font-size: 13px;
        font-weight: 500;
        z-index: 200;
        opacity: 0;
        pointer-events: none;
        transition: opacity .3s, transform .3s;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    #toast.show {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
        pointer-events: auto;
    }
    #toast.error { background: #dc2626; }

    /* ── Responsive ──────────────────────────── */
    @media (max-width: 1024px) {
        .nt-page { grid-template-columns: 1fr; }
        .nt-sidebar { position: static; }
        .nt-food-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 700px) {
        .nt-food-grid { grid-template-columns: repeat(2, 1fr); }
        .nt-page { padding: 20px 16px 90px; }
    }
</style>

<!-- ── Page ───────────────────────────────────── -->
<div class="nt-page">

    <!-- ── Main Column ───────────────────────── -->
    <main class="nt-main">

        <!-- Title -->
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

        <!-- Search -->
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

        <!-- "Mais usados" section -->
        <div class="nt-section-title">🍎 Mais usados</div>

        <div class="nt-food-grid" id="food-grid">
            <?php
            $emojis = ['🥚','🍗','🍚','🌾','🫐','🍌','🍎','🥛','🥦','🥩','🐟','🧀','🥜','🫒','🍠','🫘'];
            $i = 0;
            foreach ($alimentos as $alimento):
                $emoji = $emojis[$i % count($emojis)];
                $i++;
            ?>
            <div class="food-item" data-name="<?= strtolower(htmlspecialchars($alimento['nome'])) ?>">

                <span class="food-item-emoji"><?= $emoji ?></span>
                <h3><?= htmlspecialchars($alimento['nome']) ?></h3>
                <div class="food-item-kcal"><?= $alimento['calorias'] ?> kcal</div>
                <div class="food-item-unit">P:<?= $alimento['proteinas'] ?>g · C:<?= $alimento['carboidratos'] ?>g · G:<?= $alimento['gorduras'] ?>g</div>

                <button type="button" class="btn-selecionar" onclick="toggleForm(this)">Selecionar</button>

                <form action="<?= base_url('dashboard/adicionarAlimento') ?>" method="post" class="food-item-form">
                    <input type="hidden" name="alimento_id" value="<?= $alimento['id'] ?>">
                    <input type="hidden" name="tipo_refeicao" value="<?= $tipo_refeicao ?>">
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

        <!-- Ver todos -->
        <div class="nt-ver-todos">
            <button id="btn-ver-todos" onclick="toggleVerTodos(this)">
                Ver todos os alimentos
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>

        <!-- Tip -->
        <div class="nt-tip">
            💡 <strong>Dica do dia:</strong>&nbsp; Pequenas escolhas hoje, grandes conquistas amanhã!
        </div>

    </main>

    <!-- ── Sidebar ────────────────────────────── -->
    <aside class="nt-sidebar">

        <div class="nt-summary-card">
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

        <div class="nt-info-card">
            <h4>
                <svg width="15" height="15" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                Informação importante
            </h4>
            <p>Os valores nutricionais podem variar de acordo com a marca e o modo de preparo.</p>
        </div>

    </aside>
</div>

<!-- ── Toast ──────────────────────────────────── -->
<div id="toast">
    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" id="toast-icon">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
    </svg>
    <span id="toast-message"></span>
</div>

<script>
    /* ── Toast ── */
    function showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        document.getElementById('toast-message').textContent = message;
        toast.className = type === 'error' ? 'show error' : 'show';
        clearTimeout(toast._timer);
        toast._timer = setTimeout(() => toast.className = '', 3200);
    }

    /* ── Search ── */
    const searchInput = document.getElementById('food-search');
    const clearBtn    = document.getElementById('search-clear');

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
        document.querySelectorAll('.food-item').forEach(i => i.style.display = '');
        searchInput.focus();
    });

    /* ── Selecionar toggle ── */
    function toggleForm(btn) {
        const form = btn.nextElementSibling;
        const open = form.classList.toggle('visible');
        btn.classList.toggle('active', open);
        btn.textContent = open ? 'Cancelar' : 'Selecionar';
    }

    /* ── Ver todos toggle ── */
    const INITIAL_SHOW = 8;
    const allCards = document.querySelectorAll('.food-item');
    let expanded = false;

    function applyLimit() {
        allCards.forEach((c, idx) => {
            if (!expanded && idx >= INITIAL_SHOW) c.style.display = 'none';
            else c.style.display = '';
        });
    }
    applyLimit();

    function toggleVerTodos(btn) {
        expanded = !expanded;
        applyLimit();
        btn.classList.toggle('open', expanded);
        btn.childNodes[0].textContent = expanded ? 'Ver menos ' : 'Ver todos os alimentos ';
    }

    /* ── Flash messages ── */
    window.onload = function () {
        <?php if (session()->getFlashdata('success')): ?>
            showToast('<?= session()->getFlashdata('success') ?>', 'success');
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            showToast('<?= session()->getFlashdata('error') ?>', 'error');
        <?php endif; ?>
    };
</script>