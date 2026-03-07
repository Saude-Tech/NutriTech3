const AppState = {
    currentPage: 'dashboard',
    user: {
        name: 'João Silva',
        email: 'joao@email.com',
        avatar: null,
        dailyCalorieGoal: 2000,
        currentWeight: 75,
        targetWeight: 70,
        height: 175,
        age: 28,
        activityLevel: 'moderate'
    },
    todayData: {
        calories: 0,
        protein: 0,
        carbs: 0,
        fat: 0,
        water: 0,
        meals: { breakfast: [], lunch: [], dinner: [], snack: [] }
    },
    foodDatabase: [],
    recipes: [],
    history: []
};

document.addEventListener('DOMContentLoaded', () => {
    initializeApp();
});

function initializeApp() {
    const session = checkAuthentication();
    if (!session) return;
    
    updateUserHeader();
    loadAppData();
    
    AppState.user.name = session.name || AppState.user.name;
    AppState.user.email = session.email || AppState.user.email;
    
    initializeFoodDatabase();
    initializeRecipes();
    setupEventListeners();
    updateDateDisplay();
    
    setTimeout(() => {
        hideSplashScreen();
        loadPage('dashboard');
    }, 2000);
}

// ===== Auth =====
function checkAuthentication() {
    const session = localStorage.getItem('nutritech_session');
    if (!session) {
        window.location.href = 'auth/auth.html';
        return null;
    }
    return JSON.parse(session);
}

function logout() {
    if (confirm('Tem certeza que deseja sair?')) {
        localStorage.removeItem('nutritech_session');
        showToast('Até logo! 👋');
        setTimeout(() => {
            window.location.href = 'auth/auth.html';
        }, 500);
    }
}

function toggleUserMenu() {
    document.getElementById('user-dropdown').classList.toggle('hidden');
}

document.addEventListener('click', (e) => {
    const userMenu = document.getElementById('user-menu');
    const dropdown = document.getElementById('user-dropdown');
    if (userMenu && dropdown && !userMenu.contains(e.target)) {
        dropdown.classList.add('hidden');
    }
});

function updateUserHeader() {
    const session = JSON.parse(localStorage.getItem('nutritech_session') || '{}');
    if (session) {
        const avatar = document.getElementById('user-avatar');
        const dropdownName = document.getElementById('dropdown-name');
        const dropdownEmail = document.getElementById('dropdown-email');
        if (avatar) avatar.textContent = session.name?.charAt(0).toUpperCase() || 'U';
        if (dropdownName) dropdownName.textContent = session.name || 'Usuário';
        if (dropdownEmail) dropdownEmail.textContent = session.email || '';
    }
}

// ===== Data =====
function loadAppData() {
    const savedData = localStorage.getItem('nutritech_data');
    if (savedData) {
        const parsed = JSON.parse(savedData);
        const today = new Date().toDateString();
        if (parsed.lastDate !== today) {
            if (parsed.todayData && parsed.todayData.calories > 0) {
                AppState.history.push({ date: parsed.lastDate, data: parsed.todayData });
            }
            AppState.todayData = { calories: 0, protein: 0, carbs: 0, fat: 0, water: 0, meals: { breakfast: [], lunch: [], dinner: [], snack: [] } };
        } else {
            AppState.todayData = parsed.todayData || AppState.todayData;
        }
        AppState.user = { ...AppState.user, ...parsed.user };
        AppState.history = parsed.history || [];
    }
}

function saveAppData() {
    localStorage.setItem('nutritech_data', JSON.stringify({
        user: AppState.user,
        todayData: AppState.todayData,
        history: AppState.history,
        lastDate: new Date().toDateString()
    }));
}

function initializeFoodDatabase() {
    AppState.foodDatabase = [
        { id: 1, name: 'Arroz branco cozido', calories: 130, protein: 2.7, carbs: 28, fat: 0.3, portion: 100, emoji: '🍚' },
        { id: 2, name: 'Feijão preto cozido', calories: 77, protein: 4.5, carbs: 14, fat: 0.5, portion: 100, emoji: '🫘' },
        { id: 3, name: 'Frango grelhado', calories: 165, protein: 31, carbs: 0, fat: 3.6, portion: 100, emoji: '🍗' },
        { id: 4, name: 'Ovo cozido', calories: 155, protein: 13, carbs: 1.1, fat: 11, portion: 100, emoji: '🥚' },
        { id: 5, name: 'Banana', calories: 89, protein: 1.1, carbs: 23, fat: 0.3, portion: 100, emoji: '🍌' },
        { id: 6, name: 'Maçã', calories: 52, protein: 0.3, carbs: 14, fat: 0.2, portion: 100, emoji: '🍎' },
        { id: 7, name: 'Pão francês', calories: 289, protein: 8, carbs: 57, fat: 2.4, portion: 50, emoji: '🍞' },
        { id: 8, name: 'Leite integral', calories: 61, protein: 3.2, carbs: 4.8, fat: 3.3, portion: 100, emoji: '🥛' },
        { id: 9, name: 'Café com açúcar', calories: 33, protein: 0.2, carbs: 8, fat: 0, portion: 100, emoji: '☕' },
        { id: 10, name: 'Salada verde', calories: 15, protein: 1.2, carbs: 2.5, fat: 0.2, portion: 100, emoji: '🥗' },
        { id: 11, name: 'Batata doce', calories: 86, protein: 1.6, carbs: 20, fat: 0.1, portion: 100, emoji: '🍠' },
        { id: 12, name: 'Salmão grelhado', calories: 208, protein: 20, carbs: 0, fat: 13, portion: 100, emoji: '🐟' },
        { id: 13, name: 'Aveia', calories: 389, protein: 17, carbs: 66, fat: 7, portion: 100, emoji: '🌾' },
        { id: 14, name: 'Iogurte natural', calories: 59, protein: 10, carbs: 3.6, fat: 0.4, portion: 100, emoji: '🥛' },
        { id: 15, name: 'Amêndoas', calories: 579, protein: 21, carbs: 22, fat: 50, portion: 30, emoji: '🌰' }
    ];
}

function initializeRecipes() {
    AppState.recipes = [
        { id: 1, name: 'Bowl de Açaí Proteico', image: 'https://images.unsplash.com/photo-1590301157890-4810ed352733?w=400', calories: 350, time: 10, difficulty: 'Fácil', category: 'Café da manhã', protein: 15, carbs: 45, fat: 12, ingredients: ['200g açaí', '1 banana', '30g granola', '1 scoop whey'], instructions: 'Bata o açaí com a banana. Cubra com granola e whey.' },
        { id: 2, name: 'Frango Grelhado com Legumes', image: 'https://images.unsplash.com/photo-1532550907401-a500c9a57435?w=400', calories: 420, time: 30, difficulty: 'Médio', category: 'Almoço', protein: 45, carbs: 20, fat: 18, ingredients: ['200g peito de frango', 'Brócolis', 'Cenoura', 'Abobrinha'], instructions: 'Grelhe o frango e asse os legumes com azeite.' },
        { id: 3, name: 'Overnight Oats', image: 'https://images.unsplash.com/photo-1517673400267-0251440c45dc?w=400', calories: 280, time: 5, difficulty: 'Fácil', category: 'Café da manhã', protein: 12, carbs: 40, fat: 8, ingredients: ['50g aveia', '200ml leite', 'Frutas', 'Mel'], instructions: 'Misture tudo na noite anterior e refrigere.' },
        { id: 4, name: 'Salada Caesar com Frango', image: 'https://images.unsplash.com/photo-1550304943-4f24f54ddde9?w=400', calories: 380, time: 20, difficulty: 'Fácil', category: 'Almoço', protein: 35, carbs: 15, fat: 22, ingredients: ['Alface romana', 'Frango grelhado', 'Croutons', 'Molho caesar'], instructions: 'Monte a salada com todos os ingredientes.' },
        { id: 5, name: 'Smoothie Verde Detox', image: 'https://images.unsplash.com/photo-1610970881699-44a5587cabec?w=400', calories: 150, time: 5, difficulty: 'Fácil', category: 'Lanche', protein: 3, carbs: 30, fat: 2, ingredients: ['Espinafre', 'Maçã', 'Gengibre', 'Água de coco'], instructions: 'Bata todos os ingredientes no liquidificador.' },
        { id: 6, name: 'Salmão ao Forno', image: 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=400', calories: 450, time: 25, difficulty: 'Médio', category: 'Jantar', protein: 40, carbs: 5, fat: 30, ingredients: ['200g salmão', 'Limão', 'Ervas', 'Azeite'], instructions: 'Tempere o salmão e asse a 200°C por 20 minutos.' }
    ];
}

// ===== Event Listeners =====
function setupEventListeners() {
    // Navigation (só 3 botões agora)
    document.querySelectorAll('.nav-item[data-page]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            navigateToPage(e.currentTarget.dataset.page);
        });
    });

    // Modals
    document.getElementById('close-modal').addEventListener('click', closeAddFoodModal);
    document.getElementById('add-food-modal').addEventListener('click', (e) => {
        if (e.target.id === 'add-food-modal') closeAddFoodModal();
    });

    document.getElementById('quick-add-btn').addEventListener('click', openQuickAddModal);
    document.getElementById('close-quick-modal').addEventListener('click', closeQuickAddModal);
    document.getElementById('quick-add-modal').addEventListener('click', (e) => {
        if (e.target.id === 'quick-add-modal') closeQuickAddModal();
    });

    document.getElementById('quick-add-form').addEventListener('submit', handleQuickAdd);
    document.getElementById('food-search').addEventListener('input', handleFoodSearch);

    document.querySelectorAll('.meal-type-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            document.querySelectorAll('.meal-type-btn').forEach(b => b.classList.remove('active'));
            e.target.classList.add('active');
        });
    });
}

// ===== Navigation =====
function navigateToPage(page) {
    document.querySelectorAll('.nav-item').forEach(item => {
        item.classList.remove('active');
        if (item.dataset.page === page) item.classList.add('active');
    });
    AppState.currentPage = page;
    loadPage(page);
}

function loadPage(page) {
    const mainContent = document.getElementById('main-content');
    switch(page) {
        case 'dashboard':
            if (typeof renderDashboard === 'function') { mainContent.innerHTML = renderDashboard(); initDashboard(); }
            break;
        case 'recipes':
            if (typeof renderRecipes === 'function') { mainContent.innerHTML = renderRecipes(); initRecipes(); }
            break;
        case 'profile':
            if (typeof renderProfile === 'function') { mainContent.innerHTML = renderProfile(); initProfile(); }
            break;
        default:
            mainContent.innerHTML = '<div class="p-4">Página não encontrada</div>';
    }
}

// ===== UI Functions =====
function hideSplashScreen() {
    const splash = document.getElementById('splash-screen');
    const app = document.getElementById('app');
    splash.style.opacity = '0';
    setTimeout(() => { splash.style.display = 'none'; app.style.opacity = '1'; }, 500);
}

function updateDateDisplay() {
    const dateEl = document.getElementById('current-date');
    const options = { weekday: 'long', day: 'numeric', month: 'long' };
    const today = new Date().toLocaleDateString('pt-BR', options);
    dateEl.textContent = today.charAt(0).toUpperCase() + today.slice(1);
}

function showToast(message) {
    const toast = document.getElementById('toast');
    const toastMessage = document.getElementById('toast-message');
    toastMessage.textContent = message;
    toast.classList.remove('opacity-0', 'pointer-events-none', '-translate-y-2');
    toast.classList.add('opacity-100', 'translate-y-0');
    setTimeout(() => {
        toast.classList.add('opacity-0', 'pointer-events-none', '-translate-y-2');
        toast.classList.remove('opacity-100', 'translate-y-0');
    }, 3000);
}

// ===== Food Modal Functions =====
function openAddFoodModal() {
    const modal = document.getElementById('add-food-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    loadFoodList();
}

function closeAddFoodModal() {
    const modal = document.getElementById('add-food-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.getElementById('food-search').value = '';
}

function openQuickAddModal() {
    closeAddFoodModal();
    const modal = document.getElementById('quick-add-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeQuickAddModal() {
    const modal = document.getElementById('quick-add-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.getElementById('quick-add-form').reset();
}

function loadFoodList(searchTerm = '') {
    const foodList = document.getElementById('food-list');
    let foods = AppState.foodDatabase;
    if (searchTerm) foods = foods.filter(f => f.name.toLowerCase().includes(searchTerm.toLowerCase()));
    
    foodList.innerHTML = foods.length > 0 ? foods.map(food => `
        <div class="food-card flex items-center justify-between p-3 bg-gray-50 rounded-xl mb-2 cursor-pointer hover:bg-gray-100 transition-colors" onclick="addFoodToMeal(${food.id})">
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
    `).join('') : '<div class="text-center py-8 text-gray-500"><p>Nenhum alimento encontrado</p></div>';
}

function handleFoodSearch(e) { loadFoodList(e.target.value); }

function addFoodToMeal(foodId) {
    const food = AppState.foodDatabase.find(f => f.id === foodId);
    const activeMeal = document.querySelector('.meal-type-btn.active').dataset.meal;
    if (food) {
        AppState.todayData.meals[activeMeal].push({...food, addedAt: new Date().toISOString()});
        AppState.todayData.calories += food.calories;
        AppState.todayData.protein += food.protein;
        AppState.todayData.carbs += food.carbs;
        AppState.todayData.fat += food.fat;
        saveAppData();
        showToast(`${food.name} adicionado!`);
        closeAddFoodModal();
        if (AppState.currentPage === 'dashboard') loadPage('dashboard');
    }
}

function handleQuickAdd(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const activeMeal = document.querySelector('.meal-type-btn.active')?.dataset.meal || 'snack';
    const food = {
        id: Date.now(),
        name: formData.get('name'),
        calories: parseInt(formData.get('calories')) || 0,
        protein: parseInt(formData.get('protein')) || 0,
        carbs: parseInt(formData.get('carbs')) || 0,
        fat: parseInt(formData.get('fat')) || 0,
        portion: parseInt(formData.get('portion')) || 100,
        emoji: '🍽️'
    };
    AppState.todayData.meals[activeMeal].push({...food, addedAt: new Date().toISOString()});
    AppState.todayData.calories += food.calories;
    AppState.todayData.protein += food.protein;
    AppState.todayData.carbs += food.carbs;
    AppState.todayData.fat += food.fat;
    saveAppData();
    showToast(`${food.name} adicionado!`);
    closeQuickAddModal();
    if (AppState.currentPage === 'dashboard') loadPage('dashboard');
}

// ===== Utilities =====
function formatNumber(num) { return new Intl.NumberFormat('pt-BR').format(num); }
function calculatePercentage(current, goal) { return Math.min(Math.round((current / goal) * 100), 100); }

// ===== Exports =====
window.AppState = AppState;
window.saveAppData = saveAppData;
window.showToast = showToast;
window.loadPage = loadPage;
window.formatNumber = formatNumber;
window.calculatePercentage = calculatePercentage;
window.logout = logout;
window.toggleUserMenu = toggleUserMenu;
window.navigateToPage = navigateToPage;
window.addFoodToMeal = addFoodToMeal;
window.openAddFoodModal = openAddFoodModal;
window.closeAddFoodModal = closeAddFoodModal;
window.loadFoodList = loadFoodList;