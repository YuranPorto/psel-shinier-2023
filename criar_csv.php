<?php 
    include __DIR__.'/include/Database.php';

    try {
        $dbh = new PDO(Database::DNS_CON, Database::USER_NAME, Database::DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Busca os dados da view financeiro
        $result = $dbh->query("SELECT * FROM FINANCEIRO_V ROWS 5");
      
        // Exibe os dados da view na tela
        echo "<table>";
        echo "<tr><th>Nome</th><th>CPF/CNPJ</th><th>Documento</th><th>Emissão</th><th>Vencimento</th><th>Data de Pagamento</th><th>ID Forma de Pagamento</th><th>Valor Pago</th><th>Data de Pagamento da Baixa</th></tr>";
        foreach ($result as $row) {
          echo "<tr>";
          echo "<td>{$row['NOME']}</td>";
          echo "<td>{$row['CNPJ_CPF']}</td>";
          echo "<td>{$row['DOCUMENTO']}</td>";
          echo "<td>{$row['EMISSAO']}</td>";
          echo "<td>{$row['VENCTO']}</td>";
          echo "<td>{$row['DATA_PAGTO']}</td>";
          echo "<td>{$row['ID_FORMA_PAGAMENTO']}</td>";
          echo "<td>{$row['VALOR_PAGO']}</td>";
          echo "<td>{$row['DATA_BAIXA']}</td>";
          echo "</tr>";
        }
        echo "</table>";
      
      } catch (PDOException $e) {
        // Se ocorrer algum erro na conexão ou na execução das queries, exibe a mensagem de erro
        echo "ERRO NA CONEXÃO: " . $e->getMessage();
      }
?>