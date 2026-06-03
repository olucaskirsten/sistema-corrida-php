<?php
// CONTROLADOR: EXERCÍCIOS
// Controla os exercícios que ficam dentro de cada treino.

class ControladorExercicios
{
    private $treinos;
    private $exercicios;

    public function __construct()
    {
        $this->treinos = new Treino();
        $this->exercicios = new Exercicio();
    }

    public function formulario()
    {
        Autenticacao::exigirLogin();

        $id = (int) ($_GET['id'] ?? 0);
        $item = $this->exercicios->buscarItemDoUsuario($id, Autenticacao::id());

        if (empty($item)) {
            flash('Exercício não encontrado.', 'error');
            redirect('treinos');
        }

        $treino = $this->treinos->buscarDoUsuario($item['treino_id'], Autenticacao::id());
        $opcoes = $this->exercicios->listarBase();

        view('exercicios/formulario', [
            'item' => $item,
            'treino' => $treino,
            'opcoes' => $opcoes
        ]);
    }

    public function salvar()
    {
        Autenticacao::exigirLogin();
        Seguranca::validar();

        $id = (int) ($_POST['id'] ?? 0);
        $treinoId = (int) ($_POST['treino_id'] ?? 0);
        $treino = $this->treinos->buscarDoUsuario($treinoId, Autenticacao::id());

        if (empty($treino)) {
            flash('Treino inválido.', 'error');
            redirect('treinos');
        }

        $dados = [
            'exercicio_id' => (int) ($_POST['exercicio_id'] ?? 0),
            'ordem' => (int) ($_POST['ordem'] ?? 1),
            'duracao_min' => (int) ($_POST['duracao_min'] ?? 0),
            'observacoes' => trim($_POST['observacoes'] ?? '')
        ];

        if (empty($dados['exercicio_id'])) {
            flash('Escolha um exercício.', 'error');
            redirect('treino-detalhe', ['id' => $treinoId]);
        }

        if ($id > 0) {
            $item = $this->exercicios->buscarItemDoUsuario($id, Autenticacao::id());

            if (empty($item)) {
                flash('Exercício não encontrado.', 'error');
                redirect('treinos');
            }

            $this->exercicios->atualizar($id, $dados);
            flash('Exercício atualizado com sucesso.');
        } else {
            $this->exercicios->adicionar($treinoId, $dados);
            flash('Exercício adicionado ao treino.');
        }

        redirect('treino-detalhe', ['id' => $treinoId]);
    }

    public function excluir()
    {
        Autenticacao::exigirLogin();
        Seguranca::validar();

        $id = (int) ($_POST['id'] ?? 0);
        $item = $this->exercicios->buscarItemDoUsuario($id, Autenticacao::id());

        if (empty($item)) {
            flash('Exercício não encontrado.', 'error');
            redirect('treinos');
        }

        $treinoId = (int) $item['treino_id'];
        $this->exercicios->excluir($id);

        flash('Exercício removido do treino.');
        redirect('treino-detalhe', ['id' => $treinoId]);
    }
}
