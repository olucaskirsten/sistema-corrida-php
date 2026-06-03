<!-- TREINOS | Listagem do usuário -->
<section class="espacamento">
    <div class="container">
        <div class="topo-pagina">
            <div>
                <span class="etiqueta">Meus treinos</span>
                <h1>Olá, <?= e(primeiroNome(Autenticacao::usuario()['nome'])) ?>.</h1>
                <p>Crie, edite e organize seus treinos de corrida.</p>
            </div>

            <a class="btn btn-primary" href="index.php?page=treino-formulario">Novo treino</a>
        </div>

        <?php if (empty($treinos)): ?>
            <article class="cartao">
                <h2>Nenhum treino cadastrado</h2>
                <p>Comece criando seu primeiro treino.</p>
            </article>
        <?php else: ?>
            <div class="grade">
                <?php foreach ($treinos as $treino): ?>
                    <article class="treino">
                        <div>
                            <h2>
                                <a href="index.php?page=treino-detalhe&id=<?= e((string) $treino['id']) ?>">
                                    <?= e($treino['titulo']) ?>
                                </a>
                            </h2>

                            <p>
                                <?= e($treino['descricao'] ?? 'Treino criado pelo usuário.') ?>
                            </p>
                        </div>

                        <div>
                            <div class="dados">
                                <small><?= e(dataBr($treino['data_treino'])) ?></small>
                                <span><?= e((string) $treino['distancia_km']) ?> km</span>
                            </div>

                            <div class="acoes mt-3">
                                <a class="btn btn-primary btn-sm" href="index.php?page=treino-detalhe&id=<?= e((string) $treino['id']) ?>">
                                    Abrir
                                </a>

                                <a class="btn btn-outline-light btn-sm" href="index.php?page=treino-formulario&id=<?= e((string) $treino['id']) ?>">
                                    Editar
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>