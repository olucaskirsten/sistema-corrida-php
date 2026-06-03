<!-- LOGIN | Entrada do usuário -->
<section class="tela-login">
    <form class="caixa-login" method="post" action="index.php?page=entrar-salvar">
        <?= Seguranca::campo() ?>
        <span class="etiqueta">Acesso</span>
        <h1>Entrar</h1>
        <p>Use seu e-mail e senha para acessar seus treinos.</p>

        <label>E-mail</label>
        <input type="email" name="email" value="<?= e($_COOKIE['email_lembrado'] ?? '') ?>" required>

        <label>Senha</label>
        <input type="password" name="senha" required>

        <div class="lembrar">
            <input type="checkbox" id="lembrar" name="lembrar" value="1">
            <label for="lembrar">Lembrar meu e-mail</label>
        </div>

        <button class="btn btn-primary w-100" type="submit">Entrar</button>

        <div class="links-login">
            <a href="index.php?page=cadastro">Criar conta</a>
            <a href="index.php?page=recuperar-senha">Recuperar senha</a>
        </div>
    </form>
</section>
