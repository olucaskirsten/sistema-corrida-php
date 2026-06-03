<?php
// CONTROLADOR: TREINOS
// Recebe dados dos formulários de treino e chama o Model.

class ControladorTreinos
{
    private $treinos;
    private $exercicios;

    public function __construct()
    {
        $this->treinos = new Treino();
        $this->exercicios = new Exercicio();
    }

    public function listar()
    {
        Autenticacao::exigirLogin();

        $treinos = $this->treinos->listarPorUsuario(Autenticacao::id());
        view('treinos/lista', ['treinos' => $treinos]);
    }

    public function formulario()
    {
        Autenticacao::exigirLogin();

        $id = (int) ($_GET['id'] ?? 0);
        $treino = null;

        if ($id > 0) {
            $treino = $this->treinos->buscarDoUsuario($id, Autenticacao::id());

            if (empty($treino)) {
                flash('Treino não encontrado.', 'error');
                redirect('treinos');
            }
        }

        view('treinos/formulario', ['treino' => $treino]);
    }

    public function salvar()
    {
        Autenticacao::exigirLogin();
        Seguranca::validar();

        $id = (int) ($_POST['id'] ?? 0);

        $dados = [
            'titulo' => trim($_POST['titulo'] ?? ''),
            'descricao' => trim($_POST['descricao'] ?? ''),
            'data_treino' => ($_POST['data_treino'] ?? '') ?: null,
            'distancia_km' => ($_POST['distancia_km'] ?? '') !== '' ? (float) $_POST['distancia_km'] : 0,
            'objetivo' => trim($_POST['objetivo'] ?? 'Livre') ?: 'Livre'
        ];

        if (empty($dados['titulo'])) {
            flash('Informe o nome do treino.', 'error');
            redirect('treino-formulario', $id ? ['id' => $id] : []);
        }

        if ($id > 0) {
            $this->treinos->atualizar($id, Autenticacao::id(), $dados);
            flash('Treino atualizado com sucesso.');
            redirect('treino-detalhe', ['id' => $id]);
        }

        $novoId = $this->treinos->criar(Autenticacao::id(), $dados);
        flash('Treino criado com sucesso. Agora adicione exercícios.');
        redirect('treino-detalhe', ['id' => $novoId]);
    }

    public function detalhe()
    {
        Autenticacao::exigirLogin();

        $id = (int) ($_GET['id'] ?? 0);
        $treino = $this->treinos->buscarDoUsuario($id, Autenticacao::id());

        if (empty($treino)) {
            flash('Treino não encontrado.', 'error');
            redirect('treinos');
        }

        $exercicios = $this->exercicios->listarDoTreino($id);
        $opcoes = $this->exercicios->listarBase();

        view('treinos/detalhes_treino', [
            'treino' => $treino,
            'exercicios' => $exercicios,
            'opcoes' => $opcoes
        ]);
    }

    public function excluir()
    {
        Autenticacao::exigirLogin();
        Seguranca::validar();

        $id = (int) ($_POST['id'] ?? 0);
        $this->treinos->excluir($id, Autenticacao::id());

        flash('Treino excluído com sucesso.');
        redirect('treinos');
    }
}
