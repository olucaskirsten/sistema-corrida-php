<?php
// AUTENTICAÇÃO
// Controla o login, a sessão e o usuário atual.

class Autenticacao
{
    public static function login($usuario)
    {
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'email' => $usuario['email']
        ];

        // Cookie simples exigido no trabalho: guarda o último acesso.
        setcookie('ultimo_acesso', date('d/m/Y H:i'), time() + 60 * 60 * 24 * 30, '/');
    }

    public static function check()
    {
        return !empty($_SESSION['usuario']);
    }

    public static function usuario()
    {
        return $_SESSION['usuario'] ?? null;
    }

    public static function id()
    {
        return (int) ($_SESSION['usuario']['id'] ?? 0);
    }

    public static function exigirLogin()
    {
        if (!self::check()) {
            flash('Entre na sua conta para continuar.', 'error');
            redirect('entrar');
        }
    }

    public static function logout()
    {
        unset($_SESSION['usuario']);
    }
}
