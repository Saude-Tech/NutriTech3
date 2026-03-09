// Logica de troca de abas, toggle de senha, força da senha e modal de esqueci minha senha
function switchTab(tab) {
    const forms = document.querySelectorAll('.auth-form');
    const tabs = document.querySelectorAll('.auth-tab');
    const indicator = document.getElementById('tab-indicator');

    forms.forEach(form => form.classList.remove('active'));
    tabs.forEach(t => t.classList.remove('active'));

    document.getElementById(tab + '-form').classList.add('active');
    document.querySelector(`[data-tab="${tab}"]`).classList.add('active');

    const activeTab = document.querySelector(`[data-tab="${tab}"]`);
    if (tab === 'register') {
        indicator.style.transform = 'translateX(100%)';
    } else {
        indicator.style.transform = 'translateX(0)';
    }
}

// Logica para mostrar/ocultar senha
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const wrapper = input.parentElement;
    const eyeOpen = wrapper.querySelector('.eye-open');
    const eyeClosed = wrapper.querySelector('.eye-closed');

    if (input.type === 'password') {
        input.type = 'text';
        eyeOpen.classList.add('hidden');
        eyeClosed.classList.remove('hidden');
    } else {
        input.type = 'password';
        eyeOpen.classList.remove('hidden');
        eyeClosed.classList.add('hidden');
    }
}

// Logica para mostrar o modal de esqueci minha senha
function showForgotPassword(event) {
    event.preventDefault();
    document.getElementById('forgot-modal').classList.remove('hidden');
}

//
function closeForgotPassword() {
    document.getElementById('forgot-modal').classList.add('hidden');
}

document.getElementById('register-password')?.addEventListener('input', (e) => {
    const password = e.target.value;
    const strengthFill = document.getElementById('strength-fill');
    const strengthText = document.getElementById('strength-text');

    let strength = 0;
    if (password.length >= 8) strength++;
    if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^a-zA-Z0-9]/.test(password)) strength++;

    strengthFill.className = 'strength-fill';
    if (strength <= 1) {
        strengthFill.classList.add('weak');
        strengthText.textContent = 'Fraca';
    } else if (strength <= 2) {
        strengthFill.classList.add('medium');
        strengthText.textContent = 'Média';
    } else {
        strengthFill.classList.add('strong');
        strengthText.textContent = 'Forte';
    }
});

window.addEventListener('load', () => {
    const indicator = document.getElementById('tab-indicator');
    indicator.style.transform = 'translateX(0)';
});