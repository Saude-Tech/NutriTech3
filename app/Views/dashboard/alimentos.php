<div class="p-4 sm:p-6 bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto space-y-6">

        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Adicionar Alimento</h2>
                <p class="text-gray-500 text-sm">Selecione um alimento para adicionar à sua refeição</p>
            </div>
            <a href="<?= base_url('dashboard') ?>"
                class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-xl shadow-sm hover:bg-gray-100 transition">
                Voltar
            </a>
        </div>

        <div class="relative mb-6">
            <input type="text" id="food-search" placeholder="Buscar alimento..."
                class="w-full pl-12 pr-4 py-3 bg-white border border-gray-200 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400">

            <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>

        <!-- GRID RESPONSIVO -->
        <div class="grid gap-5 sm:gap-6 grid-cols-[repeat(auto-fit,minmax(260px,1fr))]">
            <?php foreach ($alimentos as $alimento): ?>
                <div class="food-item bg-white rounded-2xl p-4 sm:p-5 shadow-md border border-gray-100 hover:shadow-lg transition flex flex-col justify-between h-full"
                    data-name="<?= strtolower(htmlspecialchars($alimento['nome'])) ?>">

                    <h3 class="font-semibold text-lg sm:text-xl text-gray-900 mb-2">
                        <?= htmlspecialchars($alimento['nome']) ?>
                    </h3>

                    <div class="mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-gray-500">Calorias</span>
                            <span class="font-bold text-green-600 text-base sm:text-lg">
                                <span data-nutriente="calorias"><?= $alimento['calorias'] ?></span> kcal
                            </span>
                        </div>

                        <div class="grid grid-cols-3 gap-2 text-center">
                            <div class="bg-blue-50 rounded-xl py-2">
                                <p class="text-xs text-gray-500">Proteína</p>
                                <p class="font-semibold text-blue-600">
                                    <span data-nutriente="proteinas"><?= $alimento['proteinas'] ?></span>g
                                </p>
                            </div>

                            <div class="bg-yellow-50 rounded-xl py-2">
                                <p class="text-xs text-gray-500">Carbo</p>
                                <p class="font-semibold text-yellow-600">
                                    <span data-nutriente="carboidratos"><?= $alimento['carboidratos'] ?></span>g
                                </p>
                            </div>

                            <div class="bg-red-50 rounded-xl py-2">
                                <p class="text-xs text-gray-500">Gordura</p>
                                <p class="font-semibold text-red-500">
                                    <span data-nutriente="gorduras"><?= $alimento['gorduras'] ?></span>g
                                </p>
                            </div>
                        </div>
                    </div>

                    <form action="<?= base_url('dashboard/adicionarAlimento') ?>" method="post" class="space-y-3 mt-auto">

                        <input type="hidden" name="alimento_id" value="<?= $alimento['id'] ?>">
                        <input type="hidden" name="tipo_refeicao" value="<?= $tipo_refeicao ?>">

                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Quantidade</label>
                            <input type="number" name="quantidade" step="0.01" min="0" data-input="quantidade"
                                class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-400">
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Unidade</label>
                            <select name="unidade_id"
                                class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-400">
                                <?php foreach ($unidades as $unidade): ?>
                                    <option value="<?= $unidade['id'] ?>" <?= $unidade['id'] == 1 ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($unidade['nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit"
                            class="w-full bg-green-500 text-white py-2.5 rounded-xl font-medium hover:bg-green-600 active:scale-[0.98] transition">
                            Adicionar
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
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

    // Lê os valores JÁ exibidos pelo PHP como base (evita divergência com DB)
    document.querySelectorAll('[data-input="quantidade"]').forEach(function (input) {
        const card = input.closest('.food-item');
        const spans = card.querySelectorAll('[data-nutriente]');

        const base = {};
        spans.forEach(span => {
            base[span.dataset.nutriente] = parseFloat(span.textContent);
        });

        input.addEventListener('input', function () {
            const quantidade = parseFloat(this.value);
            const fator = (quantidade > 0) ? quantidade / 100 : 1;

            spans.forEach(span => {
                span.textContent = (base[span.dataset.nutriente] * fator).toFixed(1);
            });
        });
    });

    // Busca de alimentos
    document.getElementById('food-search').addEventListener('input', function () {
        const query = this.value.toLowerCase();
        document.querySelectorAll('.food-item').forEach(item => {
            const name = item.dataset.name;
            item.style.display = name.includes(query) ? 'block' : 'none';
        });
    });

    // Mostrar flash messages se houver
    window.onload = function () {
        <?php if (session()->getFlashdata('success')): ?>
            showToast('<?= session()->getFlashdata('success') ?>', 'success');
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            showToast('<?= session()->getFlashdata('error') ?>', 'error');
        <?php endif; ?>
    };
</script>