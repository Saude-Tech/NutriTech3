<?php


if (!function_exists('activity_option')) {
    function activity_option($value, $title, $description, $emoji, $current = null) {

        $isActive = $current === $value;

        $activeClass = $isActive
            ? 'bg-primary/10 border-2 border-primary'
            : 'bg-gray-50 hover:bg-gray-100 border-2 border-transparent';

        $textClass = $isActive
            ? 'text-primary'
            : 'text-gray-800';

        $check = $isActive
            ? '<span class="text-primary">✓</span>'
            : '';

        return "
        <button onclick=\"setActivityLevel('{$value}')\" 
                class=\"w-full flex items-center gap-3 p-3 rounded-xl transition-colors {$activeClass}\">
            
            <span class=\"text-2xl\">{$emoji}</span>

            <div class=\"text-left flex-1\">
                <p class=\"font-medium {$textClass}\">{$title}</p>
                <p class=\"text-xs text-gray-500\">{$description}</p>
            </div>

            {$check}
        </button>
        ";
    }
}

if (!function_exists('imc')) {

}