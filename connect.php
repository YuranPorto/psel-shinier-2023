<?php 

$dsn = 'firebird:dbname=127.0.0.1/3050:C:\Program Files\Firebird\Firebird_4_0\data\new_db_name_test.fdb';
$username = 'SYSDBA';
$password = 'masterkey';

try {
    $dbh = new PDO($dsn, $username, $password);
    echo "Conexão estabelecida!";
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}

?>