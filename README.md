# RunTrack Pro

Sistema web em PHP para organização pessoal de treinos de corrida.

O usuário pode criar uma conta, fazer login, cadastrar treinos, adicionar exercícios prontos aos treinos, editar informações, excluir dados e enviar mensagens de suporte.

## Integrantes

- Lucas Kirsten
- Gustavo Purkoot
- Menando Sales

## Credenciais de teste

Usuário 1:
- E-mail: `aluno@runtrackpro.com`
- Senha: `123456`
- Código de recuperação: `ALUNO2026`

Usuário 2:
- E-mail: `marina@runtrackpro.com`
- Senha: `123456`
- Código de recuperação: `MARINA2026`

## Como rodar no XAMPP

1. Abra o XAMPP e inicie o Apache e o MySQL.
2. Copie a pasta `corrida_simplificado` para dentro de `C:/xampp/htdocs/`.
3. Acesse o phpMyAdmin em `http://localhost/phpmyadmin`.
4. Importe o arquivo `sql/runtrack_pro.sql`.
5. Acesse o projeto no navegador:

```text
http://localhost/corrida_simplificado/index.php
```

## Estrutura do projeto

```text
corrida_simplificado/
├── index.php
├── app/
│   ├── controllers/
│   ├── core/
│   ├── models/
│   └── views/
├── public/
│   └── assets/
└── sql/
    └── runtrack_pro.sql
```

## O que cada parte faz

- `index.php`: porta de entrada. Lê `$_GET['page']` e escolhe qual controlador chamar.
- `app/core/Banco.php`: cria a conexão PDO com o MySQL.
- `app/core/Autenticacao.php`: controla sessão do usuário logado e cookie de último acesso.
- `app/core/Seguranca.php`: gera e valida o token CSRF dos formulários.
- `app/core/funcoes.php`: funções simples, como `e()`, `view()`, `flash()` e `redirect()`.
- `app/models/`: classes que acessam o banco de dados com PDO.
- `app/controllers/`: classes que recebem dados de GET/POST, validam e chamam os Models.
- `app/views/`: páginas HTML/PHP exibidas para o usuário.
- `public/assets/css/style.css`: estilo visual do projeto.
- `sql/runtrack_pro.sql`: criação do banco, tabelas e dados de teste.

## Funcionalidades principais

### Páginas públicas

- Início: `index.php?page=inicio`
- Como funciona: `index.php?page=como-funciona`
- Suporte: `index.php?page=suporte`

### Login e cadastro

- Cadastro de usuário com `password_hash()`.
- Login com `password_verify()`.
- Sessão com `$_SESSION`.
- Cookie de lembrar e-mail e cookie de último acesso.

### CRUDs

1. Usuários
   - Criar conta.
   - Ver perfil.
   - Editar perfil.
   - Excluir conta.

2. Treinos
   - Criar treino.
   - Listar treinos.
   - Editar treino.
   - Excluir treino.

3. Exercícios do treino
   - Adicionar exercício ao treino.
   - Listar exercícios do treino.
   - Editar exercício do treino.
   - Remover exercício do treino.

## Segurança usada

- `htmlspecialchars()` dentro da função `e()` para proteger saídas HTML.
- PDO com `prepare()` e `execute()` nas queries com dados do usuário.
- `password_hash()` e `password_verify()` para senha.
- `$_SESSION` para usuário logado.
- `setcookie()` para lembrar e-mail e último acesso.
- Token CSRF em formulários POST sensíveis.
