<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RunTrack Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>
<!-- CABEÇALHO | Menu principal -->
<header class="cabecalho">
    <nav class="navbar navbar-expand-lg navbar-dark container">
        <a class="navbar-brand marca" href="index.php?page=inicio"><span>RunTrack</span> Pro</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <?php if (!Autenticacao::check()): ?>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=inicio">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=como-funciona">Como funciona</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=suporte">Suporte</a></li>
                    <li class="nav-item"><a class="btn btn-primary btn-sm ms-lg-2" href="index.php?page=entrar">Entrar</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=treinos">Meus treinos</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=perfil">Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=suporte">Suporte</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light btn-sm ms-lg-2" href="index.php?page=sair">Sair</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>

<main>
    <?php $flash = flash(); ?>
    <?php if ($flash): ?>
        <div class="container aviso">
            <div class="alert <?= $flash['tipo'] === 'error' ? 'alert-danger' : 'alert-success' ?>">
                <?= e($flash['mensagem']) ?>
            </div>
        </div>
    <?php endif; ?>
