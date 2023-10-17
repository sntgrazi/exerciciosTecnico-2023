<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Does the scrapping of a webpage.
 */
class Scrapper {

  /**
   * Loads paper information from the HTML and returns the array with the data.
   */
  public function scrap(\DOMDocument $dom): array {
    $papers = [];

    $divElements = $dom->getElementsByTagName('div');
    foreach ($divElements as $divElement) {
      $classAttribute = $divElement->getAttribute('class');
      if (strpos($classAttribute, 'col-sm-12 col-md-8 col-lg-8 col-md-pull-4 col-lg-pull-4') !== FALSE) {
        $paperCards = $divElement->getElementsByTagName('a');
        foreach ($paperCards as $paperCard) {
          $paper = $this->extractPaperData($paperCard);
          if ($paper) {
            $papers[] = $paper;
          }
        }
      }
    }

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Title');
    $sheet->setCellValue('C1', 'Type');

    $row = 2;
    $maxAuthors = 0;

    foreach ($papers as $paper) {
      $authors = $paper->getAuthors();
      $maxAuthors = max($maxAuthors, count($authors));
    }

    $column = 'D';
    for ($i = 1; $i <= $maxAuthors; $i++) {
      $sheet->setCellValue($column . '1', 'Author ' . $i);
      $column++;
      $sheet->setCellValue($column . '1', 'Author ' . $i . ' Institution');
      $column++;
    }

    foreach ($papers as $paper) {
      $this->writePaperDataToSheet($sheet, $paper, $row, $maxAuthors);
      $row++;
    }

    $excelFilePath = 'papers.xlsx';
    $writer = new Xlsx($spreadsheet);
    $writer->save($excelFilePath);

    return ['message' => 'Planilha gerada com sucesso!!'];
  }

  /**
   * Este método extrai dados como título, autores, ID e tipo de um cartão de papel.
   *
   * @return \Chuva\Php\WebScrapping\Entity\Paper
   *   O objeto Paper contendo os dados extraídos.
   */
  private function extractPaperData($paperCard) {
    $titleElement = $paperCard->getElementsByTagName('h4')->item(0);
    $title = $titleElement ? $titleElement->textContent : '';

    $authorElements = $paperCard->getElementsByTagName('div')->item(0)->getElementsByTagName('span');
    $authors = [];

    foreach ($authorElements as $authorElement) {
      $authorName = trim($authorElement->textContent);
      $institution = $authorElement->getAttribute('title');

      $person = new Person($authorName, $institution);
      $authors[] = $person;
    }

    $idElement = $paperCard->getElementsByTagName('div')->item(5);
    $id = $idElement ? $idElement->textContent : '';

    $typeElement = $paperCard->getElementsByTagName('div')->item(2);
    $type = $typeElement ? $typeElement->textContent : '';

    return new Paper($id, $title, $type, $authors);
  }

  /**
   * Escreve os dados do papel em uma planilha.
   *
   * Este método escreve os dados de um objeto Paper em uma planilha,
   * incluindo ID, título, tipo e informações dos autores.
   *
   * @param PHPExcel_Worksheet $sheet
   *   A planilha onde os dados serão escritos.
   * @param \Chuva\Php\WebScrapping\Entity\Paper $paper
   *   O objeto Paper contendo os dados a serem escritos.
   * @param int $row
   *   O número da linha na planilha onde os dados serão escritos.
   * @param int $maxAuthors
   *   O número máximo de autores a serem incluídos na planilha.
   */
  private function writePaperDataToSheet($sheet, $paper, $row, $maxAuthors) {
    $sheet->setCellValue('A' . $row, $paper->getId());
    $sheet->setCellValue('B' . $row, $paper->getTitle());
    $sheet->setCellValue('C' . $row, $paper->getType());

    $authors = $paper->getAuthors();
    $column = 'D';
    for ($i = 0; $i < $maxAuthors; $i++) {
      if (isset($authors[$i])) {
        $author = $authors[$i];
        $sheet->setCellValue($column . $row, $author->getName());
        $column++;
        $sheet->setCellValue($column . $row, $author->getInstitution());
        $column++;
      }
    }
  }

}
