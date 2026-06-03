<?php
// FUNÇÕES GERAIS DO SISTEMA
// Aqui ficam funções simples usadas em várias páginas.

// Protege textos vindos do usuário antes de mostrar no HTML.
function e($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

// Envia o usuário para outra página do sistema.
function redirecionar($pagina, $parametros = [])
{
    $query = array_merge(['page' => $pagina], $parametros);
    header('Location: index.php?' . http_build_query($query));
    exit;
}

// Atalho mantido para deixar o código curto.
function redirect($pagina, $parametros = [])
{
    redirecionar($pagina, $parametros);
}

// Carrega uma view dentro do cabeçalho e do rodapé.
function view($arquivo, $dados = [])
{
    // extract transforma ['treino' => ...] em $treino dentro da view.
    extract($dados);

    require APP_PATH . '/views/layouts/cabecalho.php';
    require APP_PATH . '/views/' . $arquivo . '.php';
    require APP_PATH . '/views/layouts/rodape.php';
}

// Guarda e mostra mensagens rápidas usando $_SESSION.
function flash($mensagem = null, $tipo = 'success')
{
    if ($mensagem !== null) {
        $_SESSION['flash'] = [
            'mensagem' => $mensagem,
            'tipo' => $tipo
        ];
        return null;
    }

    if (!empty($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }

    return null;
}

// Mostra data no padrão brasileiro.
function dataBr($data)
{
    if (empty($data)) {
        return '-';
    }

    return date('d/m/Y', strtotime($data));
}

// Pega só o primeiro nome do usuário.
function primeiroNome($nome)
{
    $partes = explode(' ', trim($nome));
    return $partes[0] ?? $nome;
}
