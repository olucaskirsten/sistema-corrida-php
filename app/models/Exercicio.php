<?php
// MODEL: EXERCÍCIO
// Responsável pelos exercícios prontos e exercícios do treino.

class Exercicio
{
    private $banco;

    public function __construct()
    {
        $this->banco = Banco::conectar();
    }

    public function listarBase()
    {
        $sql = 'SELECT * FROM exercicios ORDER BY categoria, nome';
        $comando = $this->banco->query($sql);
        return $comando->fetchAll();
    }

    public function listarDoTreino($treinoId)
    {
        $sql = 'SELECT te.*, e.nome, e.categoria, e.descricao
                FROM treino_exercicios te
                INNER JOIN exercicios e ON e.id = te.exercicio_id
                WHERE te.treino_id = :treino_id
                ORDER BY te.ordem ASC, te.id ASC';

        $comando = $this->banco->prepare($sql);
        $comando->execute(['treino_id' => $treinoId]);

        return $comando->fetchAll();
    }

    public function buscarItemDoUsuario($id, $usuarioId)
    {
        $sql = 'SELECT te.*
                FROM treino_exercicios te
                INNER JOIN treinos t ON t.id = te.treino_id
                WHERE te.id = :id AND t.usuario_id = :usuario_id';

        $comando = $this->banco->prepare($sql);
        $comando->execute([
            'id' => $id,
            'usuario_id' => $usuarioId
        ]);

        return $comando->fetch() ?: null;
    }

    public function adicionar($treinoId, $dados)
    {
        $sql = 'INSERT INTO treino_exercicios (treino_id, exercicio_id, ordem, duracao_min, observacoes)
                VALUES (:treino_id, :exercicio_id, :ordem, :duracao_min, :observacoes)';

        $comando = $this->banco->prepare($sql);
        return $comando->execute([
            'treino_id' => $treinoId,
            'exercicio_id' => $dados['exercicio_id'],
            'ordem' => $dados['ordem'],
            'duracao_min' => $dados['duracao_min'],
            'observacoes' => $dados['observacoes']
        ]);
    }

    public function atualizar($id, $dados)
    {
        $sql = 'UPDATE treino_exercicios
                SET exercicio_id = :exercicio_id,
                    ordem = :ordem,
                    duracao_min = :duracao_min,
                    observacoes = :observacoes
                WHERE id = :id';

        $comando = $this->banco->prepare($sql);
        return $comando->execute([
            'id' => $id,
            'exercicio_id' => $dados['exercicio_id'],
            'ordem' => $dados['ordem'],
            'duracao_min' => $dados['duracao_min'],
            'observacoes' => $dados['observacoes']
        ]);
    }

    public function excluir($id)
    {
        $sql = 'DELETE FROM treino_exercicios WHERE id = :id';
        $comando = $this->banco->prepare($sql);
        return $comando->execute(['id' => $id]);
    }
}
