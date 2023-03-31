<?php 
    // Importa as classes necessárias do PhpSpreadsheet
    require __DIR__.'/vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Style\Fill;

    // Define o nome do arquivo CSV que será lido
    $arquivoCsv = __DIR__.'/Files/financeiro.csv';

    // Carrega a planilha Excel de base
    $planinha = IOFactory::load(__DIR__.'/Files/tabela_base.xlsx');

    // Obtém a planilha ativa
    $abaPlaninha = $planinha->getActiveSheet();

    // Abre o arquivo CSV para leitura
    if (($handle = fopen($arquivoCsv, "r")) !== FALSE) {
        
        // Pula a primeira linha do arquivo CSV
        fgetcsv($handle, 1000, ";");

        // Itera sobre cada linha do arquivo CSV e as adiciona na planilha Excel
        $linha = 2;
        while (($data = fgetcsv($handle, 0, ';', '"', '\\')) !== false) {

            // Itera sobre cada célula do arquivo CSV e as adiciona na planilha Excel
            $coluna = 1;
            foreach ($data as $celula) {
                $numeroDaCelula = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($coluna) . $linha;
                $abaPlaninha->getCell($numeroDaCelula)->setValue($celula);
                $coluna++;
            }
            $linha++;
        }
        fclose($handle);

        // Define a cor de fundo das células da primeira linha
        $estiloTabela = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FF8CB6F9',
                ],
            ],
            'font' => [
                'bold' => true,
            ],
        ];
        $abaPlaninha->getStyle('A1:H1')->applyFromArray($estiloTabela);

        // Ajusta a largura das colunas
        $tamanhoColuna = [10,16, 48, 28, 20, 13, 10, 14, 19, 18, 14];
        $letraColuna = 0;
        foreach ($tamanhoColuna as $tamanho) {
            $abaPlaninha->getColumnDimensionByColumn($letraColuna)->setWidth($tamanho);
            $letraColuna++;
        }

        // Cria um objeto Writer para a planilha Excel
        $writer = IOFactory::createWriter($planinha, 'Xlsx');

        // Salva a planilha Excel em um arquivo com nome diferente
        $writer->save(__DIR__.'/Files/financeiro.xlsx');
    }
?>
