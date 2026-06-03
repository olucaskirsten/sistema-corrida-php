<!-- RECUPERAÇÃO | Nova senha -->
<section class="tela-login">
    <form class="caixa-login" method="post" action="index.php?page=recuperar-salvar">
        <?= Seguranca::campo() ?>
        <span class="etiqueta">Recuperação</span>
        <h1>Recuperar senha</h1>
        <p>Informe o e-mail, o código de recuperação e uma nova senha.</p>

        <label>E-mail</label>
        <input type="email" name="email" required>

        <label>Código de recuperação</label>
        <input type="text" name="codigo" required>

        <label>Nova senha</label>
        <input type="password" name="senha" minlength="6" required>

        <button class="btn btn-primary w-100 mt-3" type="submit">Atualizar senha</button>
        <div class="links-login"><a href="index.php?page=entrar">Voltar ao login</a></div>
    </form>
</section>
