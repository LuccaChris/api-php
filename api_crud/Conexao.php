<?php
include __DIR__ . '/config.php';
class Conexao {
    public static function conectar() {
        return new PDO(dbDrive . ':host=' . dbHost . ';dbname=' . dbName, dbUser, dbPass);
    }
}
?>