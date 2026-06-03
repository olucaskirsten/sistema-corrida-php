<?php
// =========================================================
// INDEX PRINCIPAL
// É a porta de entrada do projeto.
// Lê $_GET['page'] e chama o controlador correto.
// =========================================================

session_start();

// Caminhos principais do projeto.
define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');

// Arquivos principais.
require APP_PATH . '/core/funcoes.php';
require APP_PATH . '/core/Banco.php';
require APP_PATH . '/core/Seguranca.php';
require APP_PATH . '/core/Autenticacao.php';

// Models: classes que falam com o banco.
require APP_PATH . '/models/Usuario.php';
require APP_PATH . '/models/Treino.php';
require APP_PATH . '/models/Exercicio.php';
require APP_PATH . '/models/ChamadoSuporte.php';

// Controllers: classes que recebem a ação e decidem o que fazer.
require APP_PATH . '/controllers/ControladorSite.php';
require APP_PATH . '/controllers/ControladorAutenticacao.php';
require APP_PATH . '/controllers/ControladorUsuarios.php';
require APP_PATH . '/controllers/ControladorTreinos.php';
require APP_PATH . '/controllers/ControladorExercicios.php';
require APP_PATH . '/controllers/ControladorSuporte.php';

$pagina = $_GET['page'] ?? 'inicio';

switch ($pagina) {
    // Páginas abertas
    case 'inicio':
        (new ControladorSite())->inicio();
        break;
    case 'como-funciona':
        (new ControladorSite())->comoFunciona();
        break;
    case 'suporte':
        (new ControladorSite())->suporte();
        break;
    case 'suporte-enviar':
        (new ControladorSuporte())->salvar();
        break;

    // Login, cadastro e recuperação
    case 'entrar':
        (new ControladorAutenticacao())->mostrarLogin();
        break;
    case 'entrar-salvar':
        (new ControladorAutenticacao())->entrar();
        break;
    case 'cadastro':
        (new ControladorAutenticacao())->mostrarCadastro();
        break;
    case 'cadastro-salvar':
        (new ControladorAutenticacao())->cadastrar();
        break;
    case 'recuperar-senha':
        (new ControladorAutenticacao())->mostrarRecuperarSenha();
        break;
    case 'recuperar-salvar':
        (new ControladorAutenticacao())->recuperarSenha();
        break;
    case 'sair':
        (new ControladorAutenticacao())->sair();
        break;

    // Treinos
    case 'treinos':
        (new ControladorTreinos())->listar();
        break;
    case 'treino-formulario':
        (new ControladorTreinos())->formulario();
        break;
    case 'treino-salvar':
        (new ControladorTreinos())->salvar();
        break;
    case 'treino-detalhe':
        (new ControladorTreinos())->detalhe();
        break;
    case 'treino-excluir':
        (new ControladorTreinos())->excluir();
        break;

    // Exercícios do treino
    case 'exercicio-formulario':
        (new ControladorExercicios())->formulario();
        break;
    case 'exercicio-salvar':
        (new ControladorExercicios())->salvar();
        break;
    case 'exercicio-excluir':
        (new ControladorExercicios())->excluir();
        break;

    // Perfil do usuário
    case 'perfil':
        (new ControladorUsuarios())->perfil();
        break;
    case 'perfil-salvar':
        (new ControladorUsuarios())->salvarPerfil();
        break;
    case 'perfil-excluir':
        (new ControladorUsuarios())->excluirPerfil();
        break;

    default:
        http_response_code(404);
        view('site/nao_encontrado');
        break;
}
