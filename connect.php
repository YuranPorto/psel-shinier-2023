<?php 

$dsn = 'firebird:dbname=127.0.0.1/3050:C:\Program Files\Firebird\Firebird_4_0\data\DB_TESTE_SHINIER.fdb';
$username = 'SYSDBA';
$password = 'masterkey';

try {
    $dbh = new PDO($dsn, $username, $password);
    $sql = 'SELECT NOME FROM EMD101 ORDER BY NOME DESC ROWS 5';
    $stmt = $dbh->query($sql);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultados as $resultado){
        echo $resultado['NOME'];
    }

} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}

?>