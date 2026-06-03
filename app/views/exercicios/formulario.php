<!-- FORMULÁRIO | Editar exercício do treino -->
<section class="espacamento">
    <div class="container estreito">
        <div class="topo-pagina">
            <div>
                <span class="etiqueta">Exercício</span>
                <h1>Editar exercício</h1>
                <p>Altere o exercício, ordem, duração ou observações.</p>
            </div>
        </div>

        <form class="formulario" method="post" action="index.php?page=exercicio-salvar">
            <?= Seguranca::campo() ?>
            <input type="hidden" name="id" value="<?= e((string)$item['id']) ?>">
            <input type="hidden" name="treino_id" value="<?= e((string)$item['treino_id']) ?>">

            <label>Exercício</label>
            <select name="exercicio_id" required>
                <?php foreach ($opcoes as $opcao): ?>
                    <option value="<?= e((string)$opcao['id']) ?>" <?= (int)$item['exercicio_id'] === (int)$opcao['id'] ? 'selected' : '' ?>>
                        <?= e($opcao['categoria']) ?> - <?= e($opcao['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div class="campos-duplos">
                <div>
                    <label>Ordem</label>
                    <input type="number" name="ordem" value="<?= e((string)$item['ordem']) ?>" min="1">
                </div>
                <div>
                    <label>Duração em minutos</label>
                    <input type="number" name="duracao_min" value="<?= e((string)$item['duracao_min']) ?>" min="1">
                </div>
            </div>

            <label>Observações</label>
            <textarea name="observacoes" rows="4"><?= e($item['observacoes']) ?></textarea>

            <div class="acoes mt-3">
                <button class="btn btn-primary" type="submit">Salvar exercício</button>
                <a class="btn btn-outline-light" href="index.php?page=treino-detalhe&id=<?= e((string)$item['treino_id']) ?>">Voltar</a>
            </div>
        </form>
    </div>
</section>
