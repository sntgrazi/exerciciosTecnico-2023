<?php

namespace Chuva\Php\WebScrapping\Entity;

/**
 * The Paper class represents the row of the parsed data.
 */
class Paper {

  /**
   * Paper Id.
   *
   * @var int
   */
  public $id;

  /**
   * Paper Title.
   *
   * @var string
   */
  public $title;

  /**
   * The paper type (e.g. Poster, Nobel Prize, etc).
   *
   * @var string
   */
  public $type;

  /**
   * Paper authors.
   *
   * @var \Chuva\Php\WebScrapping\Entity\Person[]
   */
  public $authors;

  /**
   * Builder.
   */
  public function __construct($id, $title, $type, $authors = []) {
    $this->id = $id;
    $this->title = $title;
    $this->type = $type;
    $this->authors = $authors;
  }

  /**
 * Obtém o ID do item.
 *
 * @return int O ID do item.
 */
public function getId() {
  return $this->id;
}

/**
* Define o ID do item.
*
* @param int $id O ID a ser atribuído ao item.
*/
public function setId($id) {
  $this->id = $id;
}

/**
* Obtém o título do item.
*
* @return string O título do item.
*/
public function getTitle() {
  return $this->title;
}

/**
* Define o título do item.
*
* @param string $title O título a ser atribuído ao item.
*/
public function setTitle($title) {
  $this->title = $title;
}

/**
* Obtém o tipo do item.
*
* @return string O tipo do item.
*/
public function getType() {
  return $this->type;
}

/**
* Define o tipo do item.
*
* @param string $type O tipo a ser atribuído ao item.
*/
public function setType($type) {
  $this->type = $type;
}

/**
* Obtém os autores do item.
*
* @return array Os autores do item.
*/
public function getAuthors() {
  return $this->authors;
}

/**
* Define os autores do item.
*
* @param array $authors Os autores a serem atribuídos ao item.
*/
public function setAuthors($authors) {
  $this->authors = $authors;
}

}
