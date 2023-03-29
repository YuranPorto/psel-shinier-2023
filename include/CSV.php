<?php

    class CSV{

        /**
         * Método responsavel por ler um arquivo csv e retornar um array de dados
         *
         * @param string $arquivo
         * @param boolean $cabeçalho
         * @param string $delimitador
         * 
         * echo '<pre>'; print_r(); echo '</pre>'; exit;
         *
         * @return array
         */

        public static function lerCsv($arquivo, $cabecalho = true, $delimitador=';'){

            // VERIFICANDO EXISTENCIA DO ARQUIVO
            if(!file_exists($arquivo)){
                die("\nArquivo não encontrado\n");
            }

            // DADOS DAS LINHAS DO ARQUIVO
            $dados = [];

            // ABRE O ARQUIVO
            $csv = fopen($arquivo, 'r');

            // DADOS DO CABEÇALHO

            if($cabecalho){
                $dadosCabecalho = fgetcsv($csv, 0, $delimitador);
     
            }else{
                $dadosCabecalho = [];
            }

            // Lendo todas as linhas do arquivo
            while ($linha = fgetcsv($csv, 0, $delimitador)){
                if($cabecalho){
                    $dados[] = array_combine($dadosCabecalho, $linha);
                }else {
                    $dados[] = $linha;
                }
            }
            // FECHA O ARQUIVO
            fclose($csv);

            return $dados;
        }

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

                // CRIA O CORPO DO CSV
                foreach($dados as $linha){
                    fputs($csv, implode($delimitador, $linha) . PHP_EOL);
                }

                // FECHA O ARQUIVO
                fclose($csv);
                return true;
         }
    }
?>