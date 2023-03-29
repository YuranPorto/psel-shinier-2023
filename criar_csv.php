<?php 
    include __DIR__.'/include/CSV.php';

    $dados = [
      [
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
      ],
      [
        '',
        'ABIGAIL SANTANA',
        'Documento 25259/01',
        'Dinheiro',
        '3000,00',
        '3000,00',
        '22/06/2021',
        '22/06/2021',
        '22/06/2021',
        '22/06/2022'
      ]
    ];

    $sucesso = CSV::criarCsv(__DIR__.'/files/base-cria.csv', $dados, ';');
    var_dump($sucesso);

?>