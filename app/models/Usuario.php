<?php
// MODEL: USUÁRIO
// Responsável pelas queries da tabela usuarios.

class Usuario
{
    private $banco;

    public function __construct()
    {
        $this->banco = Banco::conectar();
    }

    public function buscarPorId($id)
    {
        $sql = 'SELECT * FROM usuarios WHERE id = :id';
        $comando = $this->banco->prepare($sql);
        $comando->execute(['id' => $id]);

        return $comando->fetch() ?: null;
    }

    public function buscarPorEmail($email)
    {
        $sql = 'SELECT * FROM usuarios WHERE email = :email';
        $comando = $this->banco->prepare($sql);
        $comando->execute(['email' => $email]);

        return $comando->fetch() ?: null;
    }

    public function criar($nome, $email, $senha)
    {
        $codigo = strtoupper(substr(md5($email . time()), 0, 8));
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO usuarios (nome, email, senha_hash, codigo_recuperacao)
                VALUES (:nome, :email, :senha_hash, :codigo)';

        $comando = $this->banco->prepare($sql);
        return $comando->execute([
            'nome' => $nome,
            'email' => $email,
            'senha_hash' => $senhaHash,
            'codigo' => $codigo
        ]);
    }

    public function atualizarPerfil($id, $nome, $email, $senha = null)
    {
        if (!empty($senha)) {
            $sql = 'UPDATE usuarios
                    SET nome = :nome, email = :email, senha_hash = :senha_hash
                    WHERE id = :id';

            $comando = $this->banco->prepare($sql);
            return $comando->execute([
                'id' => $id,
                'nome' => $nome,
                'email' => $email,
                'senha_hash' => password_hash($senha, PASSWORD_DEFAULT)
            ]);
        }

        $sql = 'UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id';
        $comando = $this->banco->prepare($sql);
        return $comando->execute([
            'id' => $id,
            'nome' => $nome,
            'email' => $email
        ]);
    }

    public function atualizarSenha($email, $codigo, $senha)
    {
        $sql = 'UPDATE usuarios
                SET senha_hash = :senha_hash
                WHERE email = :email AND codigo_recuperacao = :codigo';

        $comando = $this->banco->prepare($sql);
        $comando->execute([
            'email' => $email,
            'codigo' => $codigo,
            'senha_hash' => password_hash($senha, PASSWORD_DEFAULT)
        ]);

        return $comando->rowCount() > 0;
    }

    public function excluir($id)
    {
        $sql = 'DELETE FROM usuarios WHERE id = :id';
        $comando = $this->banco->prepare($sql);
        return $comando->execute(['id' => $id]);
    }
}
