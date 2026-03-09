<?php

if (!function_exists('user')) {
    /**
     * Retorna os dados do usuário logado
     */
    function user(): ?array
    {
        if (!session()->get('logged_in')) {
            return null;
        }

        return [
            'id' => session()->get('id'),
            'name' => session()->get('name'),
            'email' => session()->get('email'),
        ];
    }
}

if (!function_exists('is_logged_in')) {
    /**
     * Verifica se o usuário está logado
     */
    function is_logged_in(): bool
    {
        return session()->get('logged_in') === true;
    }
}