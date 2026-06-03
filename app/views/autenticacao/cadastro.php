<!-- CADASTRO | Nova conta -->
<section class="tela-login">
    <form class="caixa-login" method="post" action="index.php?page=cadastro-salvar">
        <?= Seguranca::campo() ?>
        <span class="etiqueta">Cadastro</span>
        <h1>Criar conta</h1>
        <p>Cadastre-se para montar seus treinos de corrida.</p>

        <label>Nome</label>
        <input type="text" name="nome" required>

        <label>E-mail</label>
        <input type="email" name="email" required>

        <label>Senha</label>
        <input type="password" name="senha" minlength="6" required>

        <button class="btn btn-primary w-100 mt-3" type="submit">Criar conta</button>
        <div class="links-login"><a href="index.php?page=entrar">Já tenho conta</a></div>
    </form>
</section>
