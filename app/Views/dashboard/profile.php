<div class="p-4 md:p-6 bg-[#f8faf8] min-h-screen">
    <div class="max-w-7xl mx-auto space-y-4">

        <!-- Profile Header -->
        <div class="bg-[#f6fbf7] rounded-2xl p-5 md:p-6 profile-soft-card">
            <div class="flex flex-col md:flex-row md:items-center gap-4">
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center text-white text-4xl font-bold shadow-sm">
                    <?= $user['nome'][0] ?>
                </div>

                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-slate-800 leading-tight"><?= $user['nome'] ?></h2>
                    <p class="text-slate-500 text-sm"><?= $user['email'] ?></p>

                    <button onclick="openEditProfile()" class="mt-3 inline-flex items-center gap-2 px-4 py-2 rounded-full border border-green-300 text-green-600 text-sm font-semibold bg-white hover:bg-green-50 transition">
                        <span>✏️</span>
                        <span>Editar perfil</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl p-5 profile-soft-card">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-green-50 flex items-center justify-center text-2xl">
                        ⚖️
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Peso Atual</p>
                        <p class="text-2xl font-bold text-slate-800">
                            <?= round($user['peso']) ?> <span class="text-base font-medium text-slate-500">kg</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 profile-soft-card">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-green-50 flex items-center justify-center text-2xl">
                        🎯
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Meta de Peso</p>
                        <p class="text-2xl font-bold text-green-600" id="meta-peso">
                            <?= $meta['meta_peso'] ?> <span class="text-base font-medium text-green-500">kg</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 profile-soft-card">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-green-50 flex items-center justify-center text-2xl">
                        📏
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Altura</p>
                        <p class="text-2xl font-bold text-slate-800">
                            <?= $user['altura'] ?> <span class="text-base font-medium text-slate-500">cm</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 profile-soft-card">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-green-50 flex items-center justify-center text-2xl">
                        🥗
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">IMC</p>
                        <p class="text-2xl font-bold text-slate-800">
                            <?= calcularIMC($user['peso'], $user['altura']) ?>
                        </p>
                        <p class="text-sm text-slate-400"><?= imc($user['peso'], $user['altura']) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daily Goal -->
        <div class="bg-white rounded-2xl p-5 md:p-6 profile-soft-card">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center text-3xl">
                        🔥
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Meta Calórica Diária</p>
                        <p class="text-4xl font-bold text-green-600 leading-none" id="meta-calorias">
                            <?= $meta['meta_calorias'] ?> kcal
                        </p>
                        <p class="text-sm text-slate-500 mt-1">calorias por dia</p>
                    </div>
                </div>

                <div>
                    <button onclick="openCalorieGoalModal()" class="px-5 py-2.5 rounded-full border border-green-300 text-green-600 font-semibold text-sm bg-white hover:bg-green-50 transition">
                        Ajustar meta
                    </button>
                </div>
            </div>
        </div>

        <!-- Activity Level -->
        <div class="bg-white rounded-2xl p-5 md:p-6 profile-soft-card">
            <h3 class="text-xl font-bold text-slate-800 mb-4">Nível de Atividade</h3>

            <div class="activity-grid grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                <?= activity_option('1', 'Sedentário', 'Pouco ou nenhum exercício', '🪑', $meta['nivel_atividade']) ?>

                <?= activity_option('2', 'Levemente Ativo', 'Exercício leve 1-3 dias/semana', '🚶', $meta['nivel_atividade'] ?? null) ?>

                <?= activity_option('3', 'Moderadamente Ativo', 'Exercício moderado 3-5 dias/semana', '🏃', $meta['nivel_atividade'] ?? null) ?>

                <?= activity_option('4', 'Muito Ativo', 'Exercício intenso 6-7 dias/semana', '💪', $meta['nivel_atividade'] ?? null) ?>
            </div>
        </div>

        <!-- Settings -->
        <div id="configuracoes" class="bg-white rounded-2xl overflow-hidden profile-soft-card">
            <div class="px-5 py-4 border-b border-slate-100">
                <h3 class="text-xl font-bold text-slate-800">Configurações</h3>
            </div>

            <!-- Logout -->
            <a href="<?= base_url('auth/logout') ?>" class="w-full flex items-center justify-between px-5 py-4 hover:bg-red-50 transition border-b border-slate-100">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 rounded-xl bg-red-50 flex items-center justify-center text-xl">
                        🚪
                    </div>
                    <div class="text-left">
                        <p class="font-semibold text-red-600">Sair da Conta</p>
                        <p class="text-sm text-slate-500">Encerrar sessão atual</p>
                    </div>
                </div>

                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <!-- Reset -->
            <button onclick="resetData()" class="w-full flex items-center justify-between px-5 py-4 hover:bg-red-50 transition">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 rounded-xl bg-red-50 flex items-center justify-center text-xl">
                        🗑️
                    </div>
                    <div class="text-left">
                        <p class="font-semibold text-red-600">Resetar Dados</p>
                        <p class="text-sm text-slate-500">Apagar todo o histórico</p>
                    </div>
                </div>

                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <!-- App Info -->
        <div class="text-center py-4">
            <p class="text-sm text-slate-400">NutriTech v1.0.0</p>
            <p class="text-xs text-slate-300 mt-1">Feito com 💚 para sua saúde</p>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div id="edit-profile-modal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-md animate-slide-up">
        <div class="p-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800">Editar Perfil</h2>
            <button onclick="closeEditProfile()" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="edit-profile-form" method="post" action="<?= base_url('perfil/atualizarPerfil') ?>" class="p-4 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                <input type="text" name="name" value="<?= $user['nome'] ?>" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="<?= $user['email'] ?>" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Peso Atual (kg)</label>
                    <input type="number" name="currentWeight" value="<?= $user['peso'] ?>" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta de Peso (kg)</label>
                    <input type="number" name="targetWeight" value="<?= $meta['meta_peso'] ?>" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Altura (cm)</label>
                    <input type="number" name="height" value="<?= $user['altura'] ?>" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Idade</label>
                    <input type="number" name="age" value="<?= $user['idade'] ?>" required class="w-full px-4 py-3 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
                </div>
            </div>
            <button type="submit" class="w-full py-3 bg-gradient-to-r from-primary to-secondary text-white rounded-xl font-medium">
                Salvar Alterações
            </button>
        </form>
    </div>
</div>

<!-- Calorie Goal Modal -->
<div id="calorie-goal-modal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-md animate-slide-up">
        <div class="p-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800">Meta Calórica</h2>
            <button onclick="closeCalorieGoalModal()" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form action="<?= base_url('perfil/atualizarCalorias') ?>" method="post">
            <div class="p-4 space-y-4">
                <div class="text-center py-4">
                    <p class="text-sm text-gray-500 mb-2">Meta diária de calorias</p>
                    <input type="number" id="calorie-goal-input" name="calorias" value="<?= $meta['meta_calorias'] ?>" class="text-4xl font-bold text-center text-gray-800 bg-transparent w-32 focus:outline-none">
                    <p class="text-gray-500">kcal</p>
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="text-sm text-gray-600 mb-2">Sugestões:</p>
                    <div class="space-y-2">
                        <button type="button" onclick="setCalorieGoal(<?= calculateSuggestedCalories('lose', $user, $meta) ?>)" class="w-full py-2 px-4 bg-white rounded-lg text-left hover:bg-primary/10 transition-colors">
                            <p class="font-medium text-gray-800">🔥 Perder peso</p>
                            <p class="text-sm text-gray-500"><?= round(calculateSuggestedCalories('lose', $user, $meta)) ?> kcal/dia</p>
                        </button>
                        <button type="button" onclick="setCalorieGoal(<?= calculateSuggestedCalories('maintrain',$user, $meta) ?>)" class="w-full py-2 px-4 bg-white rounded-lg text-left hover:bg-primary/10 transition-colors">
                            <p class="font-medium text-gray-800">⚖️ Manter peso</p>
                            <p class="text-sm text-gray-500"><?= round(calculateSuggestedCalories('maintrain', $user, $meta)) ?> kcal/dia</p>
                        </button>
                        <button type="button" onclick="setCalorieGoal(<?= calculateSuggestedCalories('gain', $user, $meta) ?>)" class="w-full py-2 px-4 bg-white rounded-lg text-left hover:bg-primary/10 transition-colors">
                            <p class="font-medium text-gray-800">💪 Ganhar massa</p>
                            <p class="text-sm text-gray-500"><?= round(calculateSuggestedCalories('gain', $user, $meta)) ?> kcal/dia</p>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full py-3 bg-gradient-to-r from-primary to-secondary text-white rounded-xl font-medium hover:opacity-90 transition-opacity">
                    Salvar Meta
                </button>
            </div>
        </form>
    </div>
</div>

<script src="<?= base_url('assets/js/profile.js') ?>"></script>
<script>
    function openEditModal() {
        document.getElementById('edit-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeEditModal() {
        document.getElementById('edit-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function saveProfile(e) {
        closeEditModal();
    }

    function openCalorieModal() {
        document.getElementById('calorie-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeCalorieModal() {
        document.getElementById('calorie-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function setCalorie(value) {
        document.getElementById('calorie-input').value = value;
    }

    function saveCalorie() {
        alert('Meta calórica atualizada!');
        closeCalorieModal();
    }

    function toggleSwitch(element, event) {
        event.stopPropagation();
        element.classList.toggle('active');
    }

    function enviarAtualizacao(botaoClicado, url, nivel) {
        const inputCalorias = document.getElementById('meta-calorias');
        const inputPeso = document.getElementById('meta-peso');

        const calorias = inputCalorias ? inputCalorias.value : null;
        const peso = inputPeso ? inputPeso.value : null;

        const dados = {
            nivel: nivel,
            calorias: calorias,
            peso: peso
        };

        if (botaoClicado) botaoClicado.disabled = true;

        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify(dados)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Erro no servidor: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    atualizarCoresDosBotoes(botaoClicado);
                } else {
                    console.error('Erro retornado pela API:', data.message || 'Erro desconhecido');
                }
            })
            .catch(erro => {
                console.error('Erro de conexão ou servidor:', erro);
            })
            .finally(() => {
                if (botaoClicado) botaoClicado.disabled = false;
            });
    }

    function setCalorieGoal(value) {
        document.getElementById('calorie-goal-input').value = value;
    }

    function atualizarCoresDosBotoes(botaoAtivo) {
        const todosBotoes = document.querySelectorAll('.btn-atividade');

        todosBotoes.forEach(btn => {
            btn.classList.remove('bg-primary/10', 'border-primary', 'is-active');
            btn.classList.add('bg-gray-50', 'hover:bg-gray-100', 'border-transparent');

            const titulo = btn.querySelector('.titulo-atividade');
            if (titulo) {
                titulo.classList.remove('text-primary');
                titulo.classList.add('text-gray-800');
            }

            const check = btn.querySelector('.icon-check');
            if (check) {
                check.classList.add('hidden');
            }
        });

        botaoAtivo.classList.remove('bg-gray-50', 'hover:bg-gray-100', 'border-transparent');
        botaoAtivo.classList.add('bg-primary/10', 'border-primary', 'is-active');

        const tituloAtivo = botaoAtivo.querySelector('.titulo-atividade');
        if (tituloAtivo) {
            tituloAtivo.classList.remove('text-gray-800');
            tituloAtivo.classList.add('text-primary');
        }

        const checkAtivo = botaoAtivo.querySelector('.icon-check');
        if (checkAtivo) {
            checkAtivo.classList.remove('hidden');
        }
    }

    document.querySelectorAll('.activity-option').forEach(option => {
        option.addEventListener('click', () => {
            document.querySelectorAll('.activity-option').forEach(o => {
                o.classList.remove('active');
                const check = o.querySelector('.activity-check');
                if (check) check.remove();
            });
            option.classList.add('active');
            if (!option.querySelector('.activity-check')) {
                const check = document.createElement('span');
                check.className = 'activity-check';
                check.textContent = '✓';
                option.appendChild(check);
            }
        });
    });
</script>
</body>
</html>