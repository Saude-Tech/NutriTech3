<?php if (session()->getFlashdata('success')): ?>
    <div id="modal-sucesso" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 transition-opacity duration-300">
        
        <div class="bg-white rounded-2xl shadow-2xl p-6 max-w-sm w-full mx-4 transform transition-all duration-300 scale-100 text-center animate-slide-up">
            
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            
            <h3 class="text-lg font-bold text-gray-900 mb-2">Sucesso!</h3>
            <p class="text-gray-600">
                <?= session()->getFlashdata('success') ?>
            </p>
            
            <div class="w-full bg-gray-200 rounded-full h-1.5 mt-6 overflow-hidden">
                <div class="bg-green-500 h-1.5 rounded-full animate-shrink-bar" style="width: 100%;"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modal-sucesso');
            
            if (modal) {
                // Configura o tempo para 5000 milissegundos (5 segundos)
                setTimeout(() => {
                    // Adiciona classe para sumir suavemente
                    modal.classList.remove('opacity-100');
                    modal.classList.add('opacity-0');
                    
                    // Espera a animação de opacidade terminar (300ms) para remover do HTML
                    setTimeout(() => {
                        modal.style.display = 'none';
                        modal.remove();
                    }, 300);
                }, 3000);
            }
        });
    </script>
    
    <style>
        @keyframes shrink-bar {
            from { width: 100%; }
            to { width: 0%; }
        }
        .animate-shrink-bar {
            animation: shrink-bar 5s linear forwards;
        }
    </style>
<?php endif; ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#22c55e',
                        secondary: '#16a34a',
                        accent: '#86efac'
                    }
                }
            }
        }
        </script>
    <link rel="stylesheet" href="<?= base_url("assets/css/{$style}.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/" . ($style2 ?? '') . ".css") ?>">
</head>

<body class="<?= $title !== 'AUTH' ? 'bg-gray-50 min-h-screen' : 'min-h-screen bg-gradient-to-br from-primary to-secondary' ?>">
