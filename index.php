<?php 

include __DIR__.'/include/Database.php';

    $obDatabase = new Database('');
    $pdo = new PDO(Database::DNS_CON, Database::USER_NAME, Database::DB_PASSWORD);

    $obDatabase->verificaView('V_FINANCEIRO', $pdo);

    try {
        $pdo = new PDO(Database::DNS_CON, Database::USER_NAME, Database::DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'SUCESSO';
    } catch (PDOException $e) {
        echo 'Erro na conexão: ' . $e->getMessage();
    }
?>