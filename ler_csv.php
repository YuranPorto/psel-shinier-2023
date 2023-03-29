<?php 
    include __DIR__.'/include/CSV.php';

    $dados = CSV::lerCsv(__DIR__.'/files/base-cria.csv', true, ';');
    print_r($dados);

?>