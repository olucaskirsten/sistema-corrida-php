<!-- PERFIL | Dados do usuário -->
<section class="espacamento">
    <div class="container estreito">
        <div class="topo-pagina">
            <div>
                <span class="etiqueta">Perfil</span>
                <h1>Minha conta</h1>
                <p>Atualize seus dados de acesso quando precisar.</p>
            </div>
        </div>

        <form class="formulario" method="post" action="index.php?page=perfil-salvar">
            <?= Seguranca::campo() ?>

            <label>Nome</label>
            <input type="text" name="nome" value="<?= e($usuario['nome'] ?? '') ?>" required>

            <label>E-mail</label>
            <input type="email" name="email" value="<?= e($usuario['email'] ?? '') ?>" required>

            <label>Nova senha</label>
            <input type="password" name="senha" placeholder="Preencha apenas se quiser trocar">

            <button class="btn btn-primary mt-3" type="submit">Salvar perfil</button>
        </form>

        <form class="mt-4" method="post" action="index.php?page=perfil-excluir" onsubmit="return confirm('Deseja excluir sua conta?')">
            <?= Seguranca::campo() ?>
            <button class="btn btn-outline-light" type="submit">Excluir minha conta</button>
        </form>
    </div>
</section>
