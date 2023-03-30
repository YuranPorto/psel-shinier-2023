<?php 
  include __DIR__.'/include/CSV.php';
  include __DIR__.'/include/Database.php';

  $obDatabase = new Database;
  $obDatabase-> setConnection();

  $query = "SELECT 
    NOME,
    CGC_CPF, 
    CLIENTE, 
    INSC_RG,
    ESTADO,
    DT_ULTMOV,
    VR_LIMITE,
    NUM_ENDERECO,
    FONE1
    FROM EMD101
    ORDER BY NOME
    FETCH FIRST 5 ROWS ONLY
    ";

  $statement = $obDatabase->execute($query);
  $resultados = $statement->FetchAll(PDO::FETCH_ASSOC);

  // ARRAY QUE IRA GERAR O CORPO DO CSV
  $corpoCsv = array();

  // Itera cada item da tabalea, e adiciona em um array na variavel corpoCsv
  foreach ($resultados as $resultado){
    $pegarDados = [
      $resultado['NOME'],
      $resultado['CGC_CPF'],
      $resultado['CLIENTE'],
      $resultado['INSC_RG'],
      $resultado['ESTADO'],
      $resultado['DT_ULTMOV'],
      $resultado['ESTADO'],
      $resultado['VR_LIMITE'],
      $resultado['NUM_ENDERECO'],
      $resultado['FONE1']
    ];

      $corpoCsv[] = $pegarDados;
  }

  $cabecalhoCsv = $cabecalhoCsv = [
    'Nome da clinica',
    'Nome do paciente',
    'Descricao do lancamento',
    'Forma de pagamento',
    'Valor a pagar',
    'Valor pago',
    'Data de criacao do lancamento',
    'Data de vencimento',
    'Data de confirmacao do pagamento',
    'Data de recebimento'
  ];

  // Junta os dados do cabeçalho, com os dados:
  $dados = array_merge(array($cabecalhoCsv), $corpoCsv);

  $sucesso = CSV::criarCsv(__DIR__.'/files/base-cria.csv', $dados, ';');
  var_dump($sucesso);

?>