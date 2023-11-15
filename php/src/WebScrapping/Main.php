<?php

namespace Chuva\Php\WebScrapping;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Runner for the Webscrapping exercice.
 */
class Main
{
    /**
     * Main runner, instantiates a Scrapper and runs.
     */
    public static function run(): void
    {
        $dom = new \DOMDocument('1.0', 'utf-8');
        libxml_use_internal_errors(true);

        @$dom->loadHTMLFile(__DIR__.'/../../assets/origin.html');

        $data = (new Scrapper())->scrap($dom);

        // Geração da planilha

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'TITLE');
        $sheet->setCellValue('C1', 'TYPE');

        // Definir cabeçalhos para autores
        $colIndex = 4; // Começar a partir da coluna D (4ª coluna)
        $maxAuthors = max(array_map('count', array_column($data, 'authors')));

        for ($i = 1; $i <= $maxAuthors; ++$i) {
            $sheet->setCellValueByColumnAndRow($colIndex, 1, "AUTHOR $i");
            $sheet->setCellValueByColumnAndRow($colIndex + 1, 1, "AUTHOR INSTITUTION $i");
            $colIndex += 2; // Avançar duas colunas para o próximo autor
        }

        // Preencher dados
        $rowIndex = 2;
        foreach ($data as $result) {
            $sheet->setCellValueByColumnAndRow(1, $rowIndex, $result->id);
            $sheet->setCellValueByColumnAndRow(2, $rowIndex, $result->title);
            $sheet->setCellValueByColumnAndRow(3, $rowIndex, $result->type);

            // Preencher dados para autores
            $colIndex = 4;
            foreach ($result->authors as $author) {
                $sheet->setCellValueByColumnAndRow($colIndex, $rowIndex, $author->name);
                $sheet->setCellValueByColumnAndRow($colIndex + 1, $rowIndex, $author->institution);
                $colIndex += 2;
            }

            ++$rowIndex;
        }

        // Salvar planilha
        $writer = new Xlsx($spreadsheet);
        $writer->save('paper.xlsx');

        // Imprimir os dados na tela
        print_r($data);
    }
}
