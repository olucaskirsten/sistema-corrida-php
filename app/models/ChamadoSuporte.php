<?php
// MODEL: CHAMADO DE SUPORTE
// Responsável por salvar mensagens de suporte.

class ChamadoSuporte
{
    private $banco;

    public function __construct()
    {
        $this->banco = Banco::conectar();
    }

    public function criar($usuarioId, $nome, $email, $mensagem)
    {
        $sql = 'INSERT INTO chamados_suporte (usuario_id, nome, email, mensagem)
                VALUES (:usuario_id, :nome, :email, :mensagem)';

        $comando = $this->banco->prepare($sql);
        return $comando->execute([
            'usuario_id' => $usuarioId ?: null,
            'nome' => $nome,
            'email' => $email,
            'mensagem' => $mensagem
        ]);
    }
}
