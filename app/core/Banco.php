<?php
// BANCO DE DADOS
// Classe simples para conectar no MySQL usando PDO.

class Banco
{
    private static $conexao = null;

    public static function conectar()
    {
        if (self::$conexao == null) {
            $host = 'localhost';
            $nomeBanco = 'runtrack_pro';
            $usuario = 'root';
            $senha = '';

            try {
                $dsn = "mysql:host=$host;dbname=$nomeBanco;charset=utf8mb4";
                self::$conexao = new PDO($dsn, $usuario, $senha);
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $erro) {
                die('Erro ao conectar no banco de dados: ' . $erro->getMessage());
            }
        }

        return self::$conexao;
    }
}
