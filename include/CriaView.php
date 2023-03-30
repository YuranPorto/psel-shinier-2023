<?php 
    include __DIR__.'/Database.php';

    $obDatabase = new Database;
    $obDatabase->setConnection();

    $tableExists = $obDatabase->execute("SELECT COUNT(*) FROM RDB\$RELATIONS WHERE RDB\$RELATION_NAME = 'PESQUISA_SATISFACAO_V'")->fetchColumn();

    if($tableExists > 0){
        print_r('A tabela já foi criada');
    } else {
        echo 'a tabela não existe';
    }