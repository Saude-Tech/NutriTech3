<div class="p-4 space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Adicionar Alimento</h2>
            <p class="text-gray-500 text-sm">Selecione um alimento para adicionar à sua refeição</p>
        </div>
        <a href="<?= base_url('dashboard') ?>" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
            Voltar
        </a>
    </div>

    <div class="relative mb-4">
        <input type="text" id="food-search" placeholder="Buscar alimento..." class="w-full pl-10 pr-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($alimentos as $alimento): ?>
            <div class="food-item bg-white rounded-xl p-4 shadow-sm border border-gray-100" data-name="<?= strtolower(htmlspecialchars($alimento['nome'])) ?>">
                <h3 class="font-semibold text-gray-800 mb-2"><?= htmlspecialchars($alimento['nome']) ?></h3>
                <p class="text-sm text-gray-600 mb-4">
                    <span class="font-medium text-gray-700"><?= $alimento['calorias'] ?> kcal</span> •
                    P: <?= $alimento['proteinas'] ?>g •
                    C: <?= $alimento['carboidratos'] ?>g •
                    G: <?= $alimento['gorduras'] ?>g
                </p>

                <form action="<?= base_url('dashboard/adicionarAlimento') ?>" method="post" class="space-y-3">
                    <input type="hidden" name="alimento_id" value="<?= $alimento['id'] ?>">
                    <input type="hidden" name="tipo_refeicao" value="<?= $tipo_refeicao ?>">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Quantidade</label>
                        <input type="number" name="quantidade" value="0" step="0.01" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Unidade</label>
                        <select name="unidade_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/50">
                            <?php foreach ($unidades as $unidade): ?>
                                <option value="<?= $unidade['id'] ?>" <?= $unidade['id'] == 1 ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($unidade['nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-primary text-white py-2 px-4 rounded-lg hover:bg-primary/90 transition-colors">
                        Adicionar
                    </button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Toast -->
<div id="toast" class="fixed top-20 left-1/2 -translate-x-1/2 bg-gray-800 text-white px-6 py-3 rounded-xl shadow-lg z-50 opacity-0 pointer-events-none transition-all duration-300 transform -translate-y-2">
    <span id="toast-message"></span>
</div>

<script>
    // Função para mostrar toast
    function showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toast-message');
        toastMessage.textContent = message;
        toast.classList.remove('opacity-0', 'pointer-events-none');
        toast.classList.add('opacity-100', 'pointer-events-auto');
        if (type === 'error') {
            toast.classList.add('bg-red-500');
            toast.classList.remove('bg-gray-800');
        } else {
            toast.classList.add('bg-gray-800');
            toast.classList.remove('bg-red-500');
        }
        setTimeout(() => {
            toast.classList.remove('opacity-100', 'pointer-events-auto');
            toast.classList.add('opacity-0', 'pointer-events-none');
        }, 3000);
    }

    // Busca de alimentos
    document.getElementById('food-search').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        document.querySelectorAll('.food-item').forEach(item => {
            const name = item.dataset.name;
            item.style.display = name.includes(query) ? 'block' : 'none';
        });
    });

    // Mostrar flash messages se houver
    window.onload = function() {
        <?php if (session()->getFlashdata('success')): ?>
            showToast('<?= session()->getFlashdata('success') ?>', 'success');
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            showToast('<?= session()->getFlashdata('error') ?>', 'error');
        <?php endif; ?>
    };
</script>