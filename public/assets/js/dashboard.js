// ===== Dashboard Module =====

function renderDashboard() {
    const { todayData, user } = AppState;
    const caloriesRemaining = user.dailyCalorieGoal - todayData.calories;
    const caloriePercentage = calculatePercentage(todayData.calories, user.dailyCalorieGoal);
    
    const macroGoals = {
        protein: Math.round(user.dailyCalorieGoal * 0.3 / 4),
        carbs: Math.round(user.dailyCalorieGoal * 0.45 / 4),
        fat: Math.round(user.dailyCalorieGoal * 0.25 / 9)
    };
    
    return `
        <div class="p-4 space-y-6 animate-fade-in">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Olá, ${user.name.split(' ')[0]}! 👋</h2>
                    <p class="text-gray-500 text-sm">Acompanhe seu progresso de hoje</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white font-bold text-lg">
                    ${user.name.charAt(0)}
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Calorias de Hoje</h3>
                        <p class="text-sm text-gray-500 mb-4">${caloriesRemaining > 0 ? 'Restam' : 'Excedeu'} <span class="font-bold ${caloriesRemaining > 0 ? 'text-primary' : 'text-red-500'}">${Math.abs(caloriesRemaining)} kcal</span></p>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">Meta diária</span>
                                <span class="font-medium">${formatNumber(user.dailyCalorieGoal)} kcal</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">Consumido</span>
                                <span class="font-medium text-primary">${formatNumber(todayData.calories)} kcal</span>
                            </div>
                        </div>
                    </div>
                    <div class="relative w-32 h-32">
                        <svg class="w-full h-full progress-ring" viewBox="0 0 120 120">
                            <circle cx="60" cy="60" r="52" fill="none" stroke="#e5e7eb" stroke-width="12"/>
                            <circle cx="60" cy="60" r="52" fill="none" stroke="url(#gradient)" stroke-width="12"
                                    stroke-dasharray="${2 * Math.PI * 52}"
                                    stroke-dashoffset="${2 * Math.PI * 52 * (1 - caloriePercentage / 100)}"
                                    stroke-linecap="round" class="progress-ring__circle"/>
                            <defs>
                                <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#22c55e"/>
                                    <stop offset="100%" stop-color="#16a34a"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-2xl font-bold text-gray-800">${caloriePercentage}%</span>
                            <span class="text-xs text-gray-500">completo</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-3">
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center"><span class="text-sm">🥩</span></div>
                        <span class="text-sm font-medium text-gray-700">Proteína</span>
                    </div>
                    <p class="text-xl font-bold text-gray-800">${todayData.protein}g</p>
                    <div class="mt-2 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-red-400 rounded-full macro-bar" style="width: ${calculatePercentage(todayData.protein, macroGoals.protein)}%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">${macroGoals.protein}g meta</p>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center"><span class="text-sm">🍞</span></div>
                        <span class="text-sm font-medium text-gray-700">Carbos</span>
                    </div>
                    <p class="text-xl font-bold text-gray-800">${todayData.carbs}g</p>
                    <div class="mt-2 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-amber-400 rounded-full macro-bar" style="width: ${calculatePercentage(todayData.carbs, macroGoals.carbs)}%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">${macroGoals.carbs}g meta</p>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center"><span class="text-sm">🥑</span></div>
                        <span class="text-sm font-medium text-gray-700">Gordura</span>
                    </div>
                    <p class="text-xl font-bold text-gray-800">${todayData.fat}g</p>
                    <div class="mt-2 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-400 rounded-full macro-bar" style="width: ${calculatePercentage(todayData.fat, macroGoals.fat)}%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">${macroGoals.fat}g meta</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-4 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-semibold text-gray-800">Água 💧</h3>
                    <span class="text-sm text-gray-500">${todayData.water}/8 copos</span>
                </div>
                <div class="flex items-center justify-between gap-2" id="water-tracker">
                    ${Array(8).fill(0).map((_, i) => `
                        <button class="water-drop text-3xl transition-all ${i < todayData.water ? 'filled' : ''}" onclick="updateWater(${i + 1})">💧</button>
                    `).join('')}
                </div>
            </div>

            <div class="space-y-3">
                <h3 class="font-semibold text-gray-800">Refeições de Hoje</h3>
                ${renderMealSection('breakfast', '☀️ Café da Manhã', todayData.meals.breakfast)}
                ${renderMealSection('lunch', '🍽️ Almoço', todayData.meals.lunch)}
                ${renderMealSection('dinner', '🌙 Jantar', todayData.meals.dinner)}
                ${renderMealSection('snack', '🍎 Lanches', todayData.meals.snack)}
            </div>

            <div class="bg-gradient-to-br from            <div class="bg-gradient-to-br from-primary/10 to-secondary/10 rounded-2xl p-4">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-xl">💡</div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Dica do Dia</h4>
                        <p class="text-sm text-gray-600 mt-1">${getRandomTip()}</p>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function renderMealSection(mealType, title, foods) {
    const totalCalories = foods.reduce((sum, f) => sum + f.calories, 0);
    
    return `
        <div class="bg-white rounded-xl p-4 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <h4 class="font-medium text-gray-800">${title}</h4>
                <div class="flex items-center gap-2">
                    <span class="text-sm font-medium text-primary">${totalCalories} kcal</span>
                    <button class="w-8 h-8 bg-primary/10 hover:bg-primary/20 rounded-lg flex items-center justify-center transition-colors"
                            onclick="openAddFoodForMeal('${mealType}')">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            ${foods.length > 0 ? `
                <div class="space-y-2">
                    ${foods.map((food, index) => `
                        <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                            <div class="flex items-center gap-2">
                                <span class="text-lg">${food.emoji || '🍽️'}</span>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">${food.name}</p>
                                    <p class="text-xs text-gray-400">${food.portion}g</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-medium text-gray-600">${food.calories} kcal</span>
                                <button class="p-1 hover:bg-red-50 rounded-full transition-colors" 
                                        onclick="removeFoodFromMeal('${mealType}', ${index})">
                                    <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    `).join('')}
                </div>
            ` : `
                <p class="text-sm text-gray-400 text-center py-4">Nenhum alimento adicionado</p>
            `}
        </div>
    `;
}

function initDashboard() {
    // Dashboard initialization
}

function updateWater(amount) {
    AppState.todayData.water = amount;
    saveAppData();
    loadPage('dashboard');
    showToast(`Água atualizada: ${amount}/8 copos`);
}

function openAddFoodForMeal(mealType) {
    document.querySelectorAll('.meal-type-btn').forEach(btn => {
        btn.classList.remove('active');
        if (btn.dataset.meal === mealType) {
            btn.classList.add('active');
        }
    });
    openAddFoodModal();
}

function removeFoodFromMeal(mealType, index) {
    const food = AppState.todayData.meals[mealType][index];
    if (food) {
        AppState.todayData.calories -= food.calories;
        AppState.todayData.protein -= food.protein;
        AppState.todayData.carbs -= food.carbs;
        AppState.todayData.fat -= food.fat;
        AppState.todayData.meals[mealType].splice(index, 1);
        
        saveAppData();
        loadPage('dashboard');
        showToast(`${food.name} removido`);
    }
}

function getRandomTip() {
    const tips = [
        'Beba água antes das refeições para ajudar na saciedade.',
        'Inclua proteínas em todas as refeições para manter a energia.',
        'Vegetais coloridos são ricos em diferentes nutrientes.',
        'Mastigue bem os alimentos para melhor digestão.',
        'Evite distrações durante as refeições.',
        'Prepare suas refeições com antecedência.',
        'Faça pequenos lanches saudáveis entre as refeições principais.',
        'Durma bem! O sono afeta o metabolismo e a fome.'
    ];
    return tips[Math.floor(Math.random() * tips.length)];
}

function openAddFoodModal() {
    const modal = document.getElementById('add-food-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    loadFoodList();
}

function loadFoodList(searchTerm = '') {
    const foodList = document.getElementById('food-list');
    let foods = AppState.foodDatabase;
    
    if (searchTerm) {
        foods = foods.filter(f => f.name.toLowerCase().includes(searchTerm.toLowerCase()));
    }
    
    foodList.innerHTML = foods.map(food => `
        <div class="food-card flex items-center justify-between p-3 bg-gray-50 rounded-xl mb-2 cursor-pointer hover:bg-gray-100 transition-colors"
             onclick="addFoodToMeal(${food.id})">
            <div class="flex items-center gap-3">
                <span class="text-2xl">${food.emoji}</span>
                <div>
                    <p class="font-medium text-gray-800">${food.name}</p>
                    <p class="text-xs text-gray-500">${food.portion}g • P: ${food.protein}g | C: ${food.carbs}g | G: ${food.fat}g</p>
                </div>
            </div>
            <div class="text-right">
                <p class="font-bold text-primary">${food.calories}</p>
                <p class="text-xs text-gray-500">kcal</p>
            </div>
        </div>
    `).join('');
    
    if (foods.length === 0) {
        foodList.innerHTML = '<div class="text-center py-8 text-gray-500"><p>Nenhum alimento encontrado</p></div>';
    }
}

window.renderDashboard = renderDashboard;
window.initDashboard = initDashboard;
window.updateWater = updateWater;
window.openAddFoodForMeal = openAddFoodForMeal;
window.removeFoodFromMeal = removeFoodFromMeal;
window.openAddFoodModal = openAddFoodModal;
window.loadFoodList = loadFoodList;