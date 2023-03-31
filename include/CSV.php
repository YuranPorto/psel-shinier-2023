    <?php

    class CSV{

        /**
         * Método responsavel por criar um arquivo csv
         *
         * @param string $arquivo
         * @param array $dados
         * @param string $delimitador
         * 
         * echo '<pre>'; print_r(); echo '</pre>'; exit;
         *
         * @return boolean
         */

        public static function criarCsv($arquivo, $dados, $delimitador=';'){
        // ABRE ARQUIVO PARA ESCRITA
        $csv = fopen($arquivo, 'w');
        
        if (!$csv) {
            return false; // ou lance uma exceção
        }
    
        // ADICIONA BOM AO ARQUIVO
        fputs($csv, "\xEF\xBB\xBF");
    
        // CRIA O CORPO DO CSV
        foreach($dados as $linha){
            $linhaString = array_map(function($valor){
                // Convertendo valor para string e codificando em UTF-8
                return mb_convert_encoding($valor, "UTF-8", "ISO-8859-1");
            }, $linha);

            // Junta os dados do array linha, separados pelo delimitador e PHP_EOL para indicar uma quebra de linha entre cada elemento
            fputs($csv, implode($delimitador, $linhaString) . PHP_EOL);
        }
    
        // FECHA O ARQUIVO
        fclose($csv);
        return true;
        }
    }
?>