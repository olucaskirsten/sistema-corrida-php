<!-- FORMULÁRIO | Criar ou editar treino -->
<section class="espacamento">
    <div class="container estreito">
        <div class="topo-pagina">
            <div>
                <span class="etiqueta">Treino</span>
                <h1><?= $treino ? 'Editar treino' : 'Novo treino' ?></h1>
                <p>Preencha as informações principais do treino.</p>
            </div>
        </div>

        <form class="formulario" method="post" action="index.php?page=treino-salvar">
            <?= Seguranca::campo() ?>
            <input type="hidden" name="id" value="<?= e((string)($treino['id'] ?? '')) ?>">

            <label>Título</label>
            <input type="text" name="titulo" value="<?= e($treino['titulo'] ?? '') ?>" required>

            <div class="campos-duplos">
                <div>
                    <label>Data</label>
                    <input type="date" name="data_treino" value="<?= e($treino['data_treino'] ?? '') ?>">
                </div>
                <div>
                    <label>Distância em km</label>
                    <input type="number" step="0.1" name="distancia_km" value="<?= e((string)($treino['distancia_km'] ?? '0')) ?>">
                </div>
            </div>

            <label>Objetivo</label>
            <select name="objetivo">
                <?php $objetivo = $treino['objetivo'] ?? 'Livre'; ?>
                <?php foreach (['Livre', 'Leve', 'Resistência', 'Velocidade', 'Longão', 'Recuperação'] as $opcao): ?>
                    <option value="<?= e($opcao) ?>" <?= $objetivo === $opcao ? 'selected' : '' ?>><?= e($opcao) ?></option>
                <?php endforeach; ?>
            </select>

            <label>Descrição</label>
            <textarea name="descricao" rows="4"><?= e($treino['descricao'] ?? '') ?></textarea>

            <div class="acoes mt-3">
                <button class="btn btn-primary" type="submit">Salvar treino</button>
                <a class="btn btn-outline-light" href="index.php?page=treinos">Voltar</a>
            </div>
        </form>

        <?php if (!empty($treino['id'])): ?>
            <form class="mt-4" method="post" action="index.php?page=treino-excluir" onsubmit="return confirm('Deseja excluir este treino?')">
                <?= Seguranca::campo() ?>
                <input type="hidden" name="id" value="<?= e((string)$treino['id']) ?>">
                <button class="btn btn-outline-light" type="submit">Excluir treino</button>
            </form>
        <?php endif; ?>
    </div>
</section>
