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
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/<?= $style ?>.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/<?= $style2 ?? '' ?>.css">
</head>

<body class="<?= $title !== 'AUTH' ? 'bg-gray-50 min-h-screen' : 'min-h-screen bg-gradient-to-br from-primary to-secondary' ?>">
