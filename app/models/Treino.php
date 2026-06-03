<?php
// MODEL: TREINO
// Responsável pelas queries da tabela treinos.

class Treino
{
    private $banco;

    public function __construct()
    {
        $this->banco = Banco::conectar();
    }

    public function listarPorUsuario($usuarioId)
    {
        $sql = 'SELECT * FROM treinos
                WHERE usuario_id = :usuario_id
                ORDER BY data_treino DESC, id DESC';

        $comando = $this->banco->prepare($sql);
        $comando->execute(['usuario_id' => $usuarioId]);

        return $comando->fetchAll();
    }

    public function buscarDoUsuario($id, $usuarioId)
    {
        $sql = 'SELECT * FROM treinos
                WHERE id = :id AND usuario_id = :usuario_id';

        $comando = $this->banco->prepare($sql);
        $comando->execute([
            'id' => $id,
            'usuario_id' => $usuarioId
        ]);

        return $comando->fetch() ?: null;
    }

    public function criar($usuarioId, $dados)
    {
        $sql = 'INSERT INTO treinos (usuario_id, titulo, descricao, data_treino, distancia_km, objetivo)
                VALUES (:usuario_id, :titulo, :descricao, :data_treino, :distancia_km, :objetivo)';

        $comando = $this->banco->prepare($sql);
        $comando->execute([
            'usuario_id' => $usuarioId,
            'titulo' => $dados['titulo'],
            'descricao' => $dados['descricao'],
            'data_treino' => $dados['data_treino'],
            'distancia_km' => $dados['distancia_km'],
            'objetivo' => $dados['objetivo']
        ]);

        return (int) $this->banco->lastInsertId();
    }

    public function atualizar($id, $usuarioId, $dados)
    {
        $sql = 'UPDATE treinos
                SET titulo = :titulo,
                    descricao = :descricao,
                    data_treino = :data_treino,
                    distancia_km = :distancia_km,
                    objetivo = :objetivo
                WHERE id = :id AND usuario_id = :usuario_id';

        $comando = $this->banco->prepare($sql);
        return $comando->execute([
            'id' => $id,
            'usuario_id' => $usuarioId,
            'titulo' => $dados['titulo'],
            'descricao' => $dados['descricao'],
            'data_treino' => $dados['data_treino'],
            'distancia_km' => $dados['distancia_km'],
            'objetivo' => $dados['objetivo']
        ]);
    }

    public function excluir($id, $usuarioId)
    {
        $sql = 'DELETE FROM treinos WHERE id = :id AND usuario_id = :usuario_id';
        $comando = $this->banco->prepare($sql);
        return $comando->execute([
            'id' => $id,
            'usuario_id' => $usuarioId
        ]);
    }
}
