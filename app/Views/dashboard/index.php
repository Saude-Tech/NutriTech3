<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - NutriTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#22c55e',
                        secondary: '#16a34a',
                        accent: '#86efac',
                        dark: '#1a1a2e',
                        light: '#f0fdf4'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Standalone Dashboard Page -->
    <div class="max-w-lg mx-auto">
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-40">
            <div class="px-4 py-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-800">NutriTech</h1>
                            <p class="text-xs text-gray-500" id="current-date"></p>
                        </div>
                    </div>
                    <button class="p-2 hover:bg-gray-100 rounded-full transition-colors relative">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="p-4 pb-24 space-y-6">
            <!-- Greeting Section -->
            <section class="greeting-section">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Olá, João! 👋</h2>
                        <p class="text-gray-500 text-sm">Acompanhe seu progresso de hoje</p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white font-bold text-lg avatar-pulse">
                        J
                    </div>
                </div>
            </section>

            <!-- Calorie Ring Card -->
            <section class="calorie-card bg-white rounded-2xl p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Calorias de Hoje</h3>
                        <p class="text-sm text-gray-500 mb-4">Restam <span class="font-bold text-primary" id="remaining-cal">1200</span> kcal</p>
                        
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">Meta diária</span>
                                <span class="font-medium">2,000 kcal</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">Consumido</span>
                                <span class="font-medium text-primary" id="consumed-cal">800 kcal</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="calorie-ring-container">
                        <svg class="calorie-ring" viewBox="0 0 120 120">
                            <circle class="ring-bg" cx="60" cy="60" r="52"/>
                            <circle class="ring-progress" cx="60" cy="60" r="52" id="calorie-progress"/>
                            <defs>
                                <linearGradient id="progressGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#22c55e"/>
                                    <stop offset="100%" stop-color="#16a34a"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        <div class="ring-content">
                            <span class="ring-percentage" id="calorie-percentage">40%</span>
                            <span class="ring-label">completo</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Macros Section -->
            <section class="macros-section">
                <div class="grid grid-cols-3 gap-3">
                    <!-- Protein -->
                    <div class="macro-card macro-protein">
                        <div class="macro-icon">
                            <span>🥩</span>
                        </div>
                        <span class="macro-label">Proteína</span>
                        <p class="macro-value" id="protein-value">45g</p>
                        <div class="macro-progress">
                            <div class="macro-bar" id="protein-bar" style="width: 60%"></div>
                        </div>
                        <p class="macro-goal">75g meta</p>
                    </div>
                    
                    <!-- Carbs -->
                    <div class="macro-card macro-carbs">
                        <div class="macro-icon">
                            <span>🍞</span>
                        </div>
                        <span class="macro-label">Carbos</span>
                        <p class="macro-value" id="carbs-value">120g</p>
                        <div class="macro-progress">
                            <div class="macro-bar" id="carbs-bar" style="width: 48%"></div>
                        </div>
                        <p class="macro-goal">250g meta</p>
                    </div>
                    
                    <!-- Fat -->
                    <div class="macro-card macro-fat">
                        <div class="macro-icon">
                            <span>🥑</span>
                        </div>
                        <span class="macro-label">Gordura</span>
                        <p class="macro-value" id="fat-value">30g</p>
                        <div class="macro-progress">
                            <div class="macro-bar" id="fat-bar" style="width: 45%"></div>
                        </div>
                        <p class="macro-goal">67g meta</p>
                    </div>
                </div>
            </section>

            <!-- Water Tracker -->
            <section class="water-section bg-white rounded-2xl p-4 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-semibold text-gray-800">Água 💧</h3>
                    <span class="text-sm text-gray-500"><span id="water-count">3</span>/8 copos</span>
                </div>
                <div class="water-tracker" id="water-tracker">
                    <!-- Water drops will be rendered here -->
                </div>
                <div class="water-info mt-3">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Total: <span id="water-ml">750ml</span></span>
                        <span class="text-primary font-medium">Meta: 2L</span>
                    </div>
                </div>
            </section>

            <!-- Meals Section -->
            <section class="meals-section">
                <h3 class="font-semibold text-gray-800 mb-3">Refeições de Hoje</h3>
                
                <!-- Breakfast -->
                <div class="meal-card" id="meal-breakfast">
                    <div class="meal-header">
                        <div class="meal-info">
                            <span class="meal-icon">☀️</span>
                            <span class="meal-title">Café da Manhã</span>
                        </div>
                        <div class="meal-actions">
                            <span class="meal-calories">320 kcal</span>
                            <button class="meal-add-btn" onclick="openAddFoodModal('breakfast')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="meal-foods">
                        <div class="food-item">
                            <div class="food-info">
                                <span class="food-emoji">🥚</span>
                                <div>
                                    <p class="food-name">Ovos mexidos</p>
                                    <p class="food-portion">2 unidades</p>
                                </div>
                            </div>
                            <div class="food-actions">
                                <span class="food-calories">180 kcal</span>
                                <button class="food-remove-btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="food-item">
                            <div class="food-info">
                                <span class="food-emoji">🍞</span>
                                <div>
                                    <p class="food-name">Pão integral</p>
                                    <p class="food-portion">2 fatias</p>
                                </div>
                            </div>
                            <div class="food-actions">
                                <span class="food-calories">140 kcal</span>
                                <button class="food-remove-btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lunch -->
                <div class="meal-card" id="meal-lunch">
                    <div class="meal-header">
                        <div class="meal-info">
                            <span class="meal-icon">🍽️</span>
                            <span class="meal-title">Almoço</span>
                        </div>
                        <div class="meal-actions">
                            <span class="meal-calories">480 kcal</span>
                            <button class="meal-add-btn" onclick="openAddFoodModal('lunch')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="meal-foods">
                        <div class="food-item">
                            <div class="food-info">
                                <span class="food-emoji">🍚</span>
                                <div>
                                    <p class="food-name">Arroz integral</p>
                                    <p class="food-portion">150g</p>
                                </div>
                            </div>
                            <div class="food-actions">
                                <span class="food-calories">180 kcal</span>
                                <button class="food-remove-btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="food-item">
                            <div class="food-info">
                                <span class="food-emoji">🍗</span>
                                <div>
                                    <p class="food-name">Frango grelhado</p>
                                    <p class="food-portion">150g</p>
                                </div>
                            </div>
                            <div class="food-actions">
                                <span class="food-calories">250 kcal</span>
                                <button class="food-remove-btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="food-item">
                            <div class="food-info">
                                <span class="food-emoji">🥗</span>
                                <div>
                                    <p class="food-name">Salada verde</p>
                                    <p class="food-portion">100g</p>
                                </div>
                            </div>
                            <div class="food-actions">
                                <span class="food-calories">50 kcal</span>
                                <button class="food-remove-btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dinner -->
                <div class="meal-card empty" id="meal-dinner">
                    <div class="meal-header">
                        <div class="meal-info">
                            <span class="meal-icon">🌙</span>
                            <span class="meal-title">Jantar</span>
                        </div>
                        <div class="meal-actions">
                            <span class="meal-calories">0 kcal</span>
                            <button class="meal-add-btn" onclick="openAddFoodModal('dinner')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="meal-empty">
                        <p>Nenhum alimento adicionado</p>
                    </div>
                </div>

                <!-- Snacks -->
                <div class="meal-card empty" id="meal-snack">
                    <div class="meal-header">
                        <div class="meal-info">
                            <span class="meal-icon">🍎</span>
                            <span class="meal-title">Lanches</span>
                        </div>
                        <div class="meal-actions">
                            <span class="meal-calories">0 kcal</span>
                            <button class="meal-add-btn" onclick="openAddFoodModal('snack')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="meal-empty">
                        <p>Nenhum alimento adicionado</p>
                    </div>
                </div>
            </section>

            <!-- Daily Tip -->
            <section class="tip-section">
                <div class="tip-card">
                    <div class="tip-icon">💡</div>
                    <div class="tip-content">
                        <h4>Dica do Dia</h4>
                        <p id="daily-tip">Beba água antes das refeições para ajudar na saciedade e melhorar a digestão.</p>
                    </div>
                </div>
            </section>
        </main>

        <!-- Bottom Navigation -->
        <nav class="bottom-nav">
            <a href="dashboard.html" class="nav-item active">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Início</span>
            </a>
            <a href="../recipes/recipes.html" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <span>Receitas</span>
            </a>
            <button class="nav-item add-btn" id="add-food-btn">
                <div class="add-btn-circle">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <span>Adicionar</span>
            </button>
            <a href="#" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <span>Estatísticas</span>
            </a>
            <a href="../profile/profile.html" class="nav-item">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span>Perfil</span>
            </a>
        </nav>
    </div>

    <script src="<?= base_url('assets/js/dashboard.js') ?>"></script>
    <script>
        // Initialize date
        const dateEl = document.getElementById('current-date');
        const options = { weekday: 'long', day: 'numeric', month: 'long' };
        const today = new Date().toLocaleDateString('pt-BR', options);
        dateEl.textContent = today.charAt(0).toUpperCase() + today.slice(1);

        // Initialize water tracker
        function initWaterTracker() {
            const tracker = document.getElementById('water-tracker');
            let waterCount = 3;
            
            tracker.innerHTML = Array(8).fill(0).map((_, i) => `
                <button class="water-drop ${i < waterCount ? 'filled' : ''}" data-index="${i}">
                    💧
                </button>
            `).join('');

            tracker.querySelectorAll('.water-drop').forEach(drop => {
                drop.addEventListener('click', () => {
                    const index = parseInt(drop.dataset.index);
                    waterCount = index + 1;
                    document.getElementById('water-count').textContent = waterCount;
                    document.getElementById('water-ml').textContent = `${waterCount * 250}ml`;
                    initWaterTracker();
                });
            });
        }
        initWaterTracker();
    </script>
</body>
</html>