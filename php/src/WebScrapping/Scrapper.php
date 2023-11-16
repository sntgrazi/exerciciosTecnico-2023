<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;

/**
 * Does the scrapping of a webpage.
 */
class Scrapper
{
    /**
     * Loads paper information from the HTML and returns the array with the data.
     */
    public function scrap(\DOMDocument $dom): array
    {
        $xpath = new \DOMXPath($dom);

        $links = $xpath->query('//a[contains(@class, "paper-card")]');

        $papers = [];

        foreach ($links as $link) {
            $id = explode('/', $link->getAttribute('href'))[8];

            $titleElement = $link->getElementsByTagName('h4')->item(0);
            $title = $titleElement ? $titleElement->nodeValue : '';

            $typeElement = $link->getElementsByTagName('div')->item(1);
            $typeWithId = $typeElement ? $typeElement->nodeValue : '';

            preg_match('/^(.+?)(\d+)$/', $typeWithId, $matches);
            $type = isset($matches[1]) ? trim($matches[1]) : '';
            $id = isset($matches[2]) ? trim($matches[2]) : $id;

            $authorElements = $link->getElementsByTagName('span');
            $authors = [];

            foreach ($authorElements as $authorElement) {
                $author = $authorElement->nodeValue;
                $institution = $authorElement->getAttribute('title');
                $authors[] = new Person($author, $institution);
            }

            $papers[] = new Paper($id, $title, $type, $authors);
        }

        return $papers;
    }
}
