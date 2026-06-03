<?php
// SEGURANÇA
// Gera e valida o token CSRF dos formulários POST.

class Seguranca
{
    public static function token()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    public static function campo()
    {
        $token = self::token();
        return '<input type="hidden" name="csrf_token" value="' . e($token) . '">';
    }

    public static function validar()
    {
        $tokenFormulario = $_POST['csrf_token'] ?? '';
        $tokenSessao = $_SESSION['csrf_token'] ?? '';

        if (empty($tokenFormulario) || !hash_equals($tokenSessao, $tokenFormulario)) {
            flash('Ação inválida. Tente novamente.', 'error');
            redirect('inicio');
        }
    }
}
