<?php
// CONTROLADOR: AUTENTICAÇÃO
// Recebe dados de login, cadastro e recuperação de senha.

class ControladorAutenticacao
{
    private $usuarios;

    public function __construct()
    {
        $this->usuarios = new Usuario();
    }

    public function mostrarLogin()
    {
        view('autenticacao/entrar');
    }

    public function entrar()
    {
        Seguranca::validar();

        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';
        $lembrarEmail = !empty($_POST['lembrar']);

        $usuario = $this->usuarios->buscarPorEmail($email);

        if (empty($usuario) || !password_verify($senha, $usuario['senha_hash'])) {
            flash('E-mail ou senha inválidos.', 'error');
            redirect('entrar');
        }

        if ($lembrarEmail) {
            setcookie('email_lembrado', $email, time() + 60 * 60 * 24 * 30, '/');
        }

        Autenticacao::login($usuario);
        redirect('treinos');
    }

    public function mostrarCadastro()
    {
        view('autenticacao/cadastro');
    }

    public function cadastrar()
    {
        Seguranca::validar();

        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if (empty($nome) || empty($email) || strlen($senha) < 6) {
            flash('Preencha nome, e-mail e uma senha com no mínimo 6 caracteres.', 'error');
            redirect('cadastro');
        }

        if ($this->usuarios->buscarPorEmail($email)) {
            flash('Esse e-mail já está cadastrado.', 'error');
            redirect('cadastro');
        }

        $this->usuarios->criar($nome, $email, $senha);
        flash('Conta criada com sucesso. Faça login para continuar.');
        redirect('entrar');
    }

    public function mostrarRecuperarSenha()
    {
        view('autenticacao/recuperar_senha');
    }

    public function recuperarSenha()
    {
        Seguranca::validar();

        $email = trim($_POST['email'] ?? '');
        $codigo = trim($_POST['codigo'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if (empty($email) || empty($codigo) || strlen($senha) < 6) {
            flash('Preencha e-mail, código e nova senha.', 'error');
            redirect('recuperar-senha');
        }

        $salvou = $this->usuarios->atualizarSenha($email, $codigo, $senha);

        if (!$salvou) {
            flash('Não foi possível recuperar o acesso. Confira os dados.', 'error');
            redirect('recuperar-senha');
        }

        flash('Senha atualizada com sucesso.');
        redirect('entrar');
    }

    public function sair()
    {
        Autenticacao::logout();
        flash('Você saiu da sua conta.');
        redirect('inicio');
    }
}
