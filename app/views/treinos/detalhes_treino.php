<!-- DETALHE | Treino escolhido -->
<section class="espacamento">
    <div class="container">
        <article class="detalhe">
            <div>
                <span class="etiqueta">Treino</span>
                <h1><?= e($treino['titulo']) ?></h1>
                <p><?= e($treino['descricao'] ?? '') ?></p>
                <div class="acoes mt-3">
                    <a class="btn btn-primary" href="index.php?page=treino-formulario&id=<?= e((string)$treino['id']) ?>">Editar treino</a>
                    <a class="btn btn-outline-light" href="index.php?page=treinos">Voltar</a>
                </div>
            </div>
            <div class="detalhe-numeros">
                <span><strong><?= e((string)$treino['distancia_km']) ?></strong> km</span>
                <span><strong><?= e(dataBr($treino['data_treino'])) ?></strong> data</span>
                <span><strong><?= e($treino['objetivo'] ?? 'Livre') ?></strong> objetivo</span>
            </div>
        </article>

        <!-- EXERCÍCIOS | Formulário rápido -->
        <form class="formulario mb-4" method="post" action="index.php?page=exercicio-salvar">
            <?= Seguranca::campo() ?>
            <input type="hidden" name="treino_id" value="<?= e((string)$treino['id']) ?>">
            <h2>Adicionar exercício</h2>
            <div class="campos-duplos">
                <div>
                    <label>Exercício</label>
                    <select name="exercicio_id" required>
                        <option value="">Escolha um exercício</option>
                        <?php foreach ($opcoes as $opcao): ?>
                            <option value="<?= e((string)$opcao['id']) ?>"><?= e($opcao['categoria']) ?> - <?= e($opcao['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label>Ordem</label>
                    <input type="number" name="ordem" value="<?= count($exercicios) + 1 ?>" min="1">
                </div>
            </div>
            <div class="campos-duplos">
                <div>
                    <label>Duração em minutos</label>
                    <input type="number" name="duracao_min" value="10" min="1">
                </div>
                <div>
                    <label>Observações</label>
                    <input type="text" name="observacoes" placeholder="Ex.: ritmo leve, descanso curto...">
                </div>
            </div>
            <button class="btn btn-primary mt-3" type="submit">Adicionar ao treino</button>
        </form>

        <!-- EXERCÍCIOS | Lista do treino -->
        <div class="titulo compacto">
            <h2>Exercícios do treino</h2>
            <p>Essa é a sequência que você montou para este treino.</p>
        </div>

        <?php if (empty($exercicios)): ?>
            <article class="cartao"><p>Nenhum exercício adicionado ainda.</p></article>
        <?php else: ?>
            <div class="lista-exercicios">
                <?php foreach ($exercicios as $item): ?>
                    <article class="exercicio">
                        <div class="numero-exercicio"><?= e((string)$item['ordem']) ?></div>
                        <div>
                            <h3><?= e($item['nome']) ?></h3>
                            <p><?= e($item['descricao']) ?></p>
                            <div class="dados">
                                <span><?= e($item['categoria']) ?></span>
                                <small><?= e((string)$item['duracao_min']) ?> min</small>
                                <?php if (!empty($item['observacoes'])): ?><small><?= e($item['observacoes']) ?></small><?php endif; ?>
                            </div>
                        </div>
                        <div class="acoes">
                            <a class="btn btn-outline-light btn-sm" href="index.php?page=exercicio-formulario&id=<?= e((string)$item['id']) ?>">Editar</a>
                            <form method="post" action="index.php?page=exercicio-excluir" onsubmit="return confirm('Remover este exercício?')">
                                <?= Seguranca::campo() ?>
                                <input type="hidden" name="id" value="<?= e((string)$item['id']) ?>">
                                <button class="btn btn-outline-light btn-sm" type="submit">Remover</button>
                            </form>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
