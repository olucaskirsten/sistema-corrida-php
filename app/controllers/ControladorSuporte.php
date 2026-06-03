<?php
// CONTROLADOR: SUPORTE
// Recebe o formulário público de suporte.

class ControladorSuporte
{
    private $chamados;

    public function __construct()
    {
        $this->chamados = new ChamadoSuporte();
    }

    public function salvar()
    {
        Seguranca::validar();

        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $mensagem = trim($_POST['mensagem'] ?? '');

        if (empty($nome) || empty($email) || empty($mensagem)) {
            flash('Preencha todos os campos do suporte.', 'error');
            redirect('suporte');
        }

        $usuarioId = null;
        if (Autenticacao::check()) {
            $usuarioId = Autenticacao::id();
        }

        $this->chamados->criar($usuarioId, $nome, $email, $mensagem);
        flash('Mensagem enviada com sucesso.');
        redirect('suporte');
    }
}
