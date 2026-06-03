<?php
// CONTROLADOR: USUÁRIOS
// Controla a página de perfil do usuário logado.

class ControladorUsuarios
{
    private $usuarios;

    public function __construct()
    {
        $this->usuarios = new Usuario();
    }

    public function perfil()
    {
        Autenticacao::exigirLogin();

        $usuario = $this->usuarios->buscarPorId(Autenticacao::id());
        view('usuarios/perfil', ['usuario' => $usuario]);
    }

    public function salvarPerfil()
    {
        Autenticacao::exigirLogin();
        Seguranca::validar();

        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = trim($_POST['senha'] ?? '');

        if (empty($nome) || empty($email)) {
            flash('Nome e e-mail são obrigatórios.', 'error');
            redirect('perfil');
        }

        try {
            $this->usuarios->atualizarPerfil(Autenticacao::id(), $nome, $email, $senha ?: null);
        } catch (PDOException $erro) {
            flash('Não foi possível salvar. Talvez esse e-mail já esteja em uso.', 'error');
            redirect('perfil');
        }

        $_SESSION['usuario']['nome'] = $nome;
        $_SESSION['usuario']['email'] = $email;

        flash('Perfil atualizado com sucesso.');
        redirect('perfil');
    }

    public function excluirPerfil()
    {
        Autenticacao::exigirLogin();
        Seguranca::validar();

        $this->usuarios->excluir(Autenticacao::id());
        Autenticacao::logout();

        flash('Conta excluída com sucesso.');
        redirect('inicio');
    }
}
