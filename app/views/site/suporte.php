<!-- SUPORTE | Dúvidas e contato -->
<section class="espacamento">
    <div class="container">
        <div class="topo-pagina">
            <div>
                <span class="etiqueta">Suporte</span>
                <h1>Precisa de ajuda?</h1>
                <p>Veja dúvidas comuns ou envie uma mensagem pelo formulário.</p>
            </div>
        </div>

        <div class="grade mb-4">
            <article class="cartao"><h2>Como crio um treino?</h2><p>Entre na sua conta, clique em “Novo treino” e preencha os dados principais.</p></article>
            <article class="cartao"><h2>Posso editar exercícios?</h2><p>Sim. Dentro do treino, você pode alterar ordem, duração e observações.</p></article>
            <article class="cartao"><h2>Esqueci minha senha</h2><p>Use a página de recuperação com o código informado no README.</p></article>
        </div>

        <form class="formulario estreito" method="post" action="index.php?page=suporte-enviar">
            <?= Seguranca::campo() ?>
            <label>Nome</label>
            <input type="text" name="nome" value="<?= e(Autenticacao::usuario()['nome'] ?? '') ?>" required>

            <label>E-mail</label>
            <input type="email" name="email" value="<?= e(Autenticacao::usuario()['email'] ?? '') ?>" required>

            <label>Mensagem</label>
            <textarea name="mensagem" rows="5" required></textarea>

            <button class="btn btn-primary mt-3" type="submit">Enviar mensagem</button>
        </form>
    </div>
</section>
