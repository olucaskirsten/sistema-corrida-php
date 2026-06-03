DROP DATABASE IF EXISTS runtrack_pro;
CREATE DATABASE runtrack_pro CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE runtrack_pro;

-- =========================================================
-- TABELA: USUÁRIOS
-- Guarda contas de acesso da plataforma
-- =========================================================

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    codigo_recuperacao VARCHAR(30) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================================
-- TABELA: TREINOS
-- Guarda os treinos criados por cada usuário
-- =========================================================

CREATE TABLE treinos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(140) NOT NULL,
    descricao TEXT,
    data_treino DATE,
    distancia_km DECIMAL(6,2) DEFAULT 0,
    objetivo VARCHAR(60) DEFAULT 'Livre',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- =========================================================
-- TABELA: EXERCÍCIOS
-- Guarda exercícios prontos para montar os treinos
-- =========================================================

CREATE TABLE exercicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    categoria VARCHAR(80) NOT NULL,
    descricao TEXT
);

-- =========================================================
-- TABELA: TREINO_EXERCÍCIOS
-- Relaciona um treino com os exercícios escolhidos
-- =========================================================

CREATE TABLE treino_exercicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    treino_id INT NOT NULL,
    exercicio_id INT NOT NULL,
    ordem INT DEFAULT 1,
    duracao_min INT DEFAULT 10,
    observacoes TEXT,
    FOREIGN KEY (treino_id) REFERENCES treinos(id) ON DELETE CASCADE,
    FOREIGN KEY (exercicio_id) REFERENCES exercicios(id)
);

-- =========================================================
-- TABELA: CHAMADOS DE SUPORTE
-- Guarda mensagens enviadas pelo formulário de suporte
-- =========================================================

CREATE TABLE chamados_suporte (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NULL,
    nome VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL,
    mensagem TEXT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
);

-- =========================================================
-- DADOS INICIAIS: USUÁRIOS
-- Estrutura: id, nome, email, senha_hash, codigo_recuperacao
-- Senha de teste de todos: 123456
-- =========================================================

INSERT INTO usuarios (id, nome, email, senha_hash, codigo_recuperacao) VALUES
(1, 'Lucas Runner', 'aluno@runtrackpro.com', '$2y$12$QfbUjy4BhcRQS.xsrHAuFemO3zk6rb7KrJMG7K5q9r7bC.zZkW.3G', 'ALUNO2026'),
(2, 'Marina Souza', 'marina@runtrackpro.com', '$2y$12$QfbUjy4BhcRQS.xsrHAuFemO3zk6rb7KrJMG7K5q9r7bC.zZkW.3G', 'MARINA2026');

-- =========================================================
-- DADOS INICIAIS: EXERCÍCIOS PRONTOS
-- =========================================================

INSERT INTO exercicios (id, nome, categoria, descricao) VALUES
(1, 'Caminhada leve', 'Aquecimento', 'Atividade leve para preparar o corpo antes da corrida.'),
(2, 'Trote confortável', 'Aquecimento', 'Corrida bem leve para ativar a respiração e a musculatura.'),
(3, 'Corrida leve', 'Base', 'Corrida em ritmo tranquilo para melhorar resistência.'),
(4, 'Corrida moderada', 'Base', 'Corrida em ritmo constante com esforço controlado.'),
(5, 'Tiro de 200m', 'Velocidade', 'Corrida curta em ritmo forte com descanso entre repetições.'),
(6, 'Tiro de 400m', 'Velocidade', 'Intervalo de velocidade para melhorar ritmo e potência.'),
(7, 'Subida curta', 'Força', 'Corrida em subida para fortalecer pernas e melhorar técnica.'),
(8, 'Longão leve', 'Resistência', 'Corrida mais longa em ritmo confortável.'),
(9, 'Ritmo progressivo', 'Ritmo', 'Começa leve e aumenta o ritmo aos poucos.'),
(10, 'Desaquecimento', 'Finalização', 'Corrida ou caminhada leve para finalizar o treino.'),
(11, 'Alongamento', 'Finalização', 'Alongamentos leves depois do treino.'),
(12, 'Fortalecimento básico', 'Força', 'Exercícios simples para complementar a corrida.');

-- =========================================================
-- DADOS INICIAIS: TREINOS
-- =========================================================

INSERT INTO treinos (id, usuario_id, titulo, descricao, data_treino, distancia_km, objetivo) VALUES
(1, 1, 'Treino leve 5 km', 'Treino simples para manter constância durante a semana.', '2026-06-05', 5.00, 'Leve'),
(2, 1, 'Treino de velocidade', 'Sessão com tiros curtos para melhorar ritmo.', '2026-06-07', 4.00, 'Velocidade'),
(3, 1, 'Longão de domingo', 'Treino mais longo em ritmo confortável.', '2026-06-09', 10.00, 'Longão'),
(4, 2, 'Base de corrida', 'Treino leve para evolução gradual.', '2026-06-05', 4.50, 'Resistência'),
(5, 2, 'Treino progressivo', 'Treino com aumento de intensidade ao longo da sessão.', '2026-06-08', 6.00, 'Velocidade');

-- =========================================================
-- DADOS INICIAIS: EXERCÍCIOS DENTRO DOS TREINOS
-- =========================================================

INSERT INTO treino_exercicios (treino_id, exercicio_id, ordem, duracao_min, observacoes) VALUES
(1, 1, 1, 8, 'Começar bem leve'),
(1, 3, 2, 30, 'Manter ritmo confortável'),
(1, 10, 3, 5, 'Finalizar sem pressa'),
(2, 2, 1, 10, 'Aquecimento'),
(2, 5, 2, 15, 'Repetir com descanso'),
(2, 10, 3, 5, 'Desacelerar'),
(3, 2, 1, 10, 'Preparação'),
(3, 8, 2, 60, 'Ritmo leve'),
(3, 11, 3, 8, 'Alongar no final'),
(4, 1, 1, 8, 'Aquecimento'),
(4, 4, 2, 28, 'Ritmo constante'),
(4, 10, 3, 6, 'Finalizar leve'),
(5, 2, 1, 10, 'Começo leve'),
(5, 9, 2, 35, 'Aumentar o ritmo aos poucos'),
(5, 11, 3, 8, 'Alongamento final');
