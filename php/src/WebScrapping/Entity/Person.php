<?php

namespace Chuva\Php\WebScrapping\Entity;

/**
 * Paper Author personal information.
 */
class Person {

  /**
   * Person name.
   */
  public string $name;

  /**
   * Person institution.
   */
  public string $institution;

  /**
   * Builder.
   */
  public function __construct($name, $institution) {
    $this->name = $name;
    $this->institution = $institution;
  }

  /**
   * Obtém o nome da pessoa.
   *
   * @return string
   *   O nome da pessoa.
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Define o nome da pessoa.
   *
   * @param string $name
   *   O nome a ser atribuído à pessoa.
   */
  public function setName($name) {
    $this->name = $name;
  }

  /**
   * Obtém a instituição da pessoa.
   *
   * @return string
   *   A instituição da pessoa.
   */
  public function getInstitution() {
    return $this->institution;
  }

  /**
   * Define a instituição da pessoa.
   *
   * @param string $institution
   *   A instituição a ser atribuída à pessoa.
   */
  public function setInstitution($institution) {
    $this->institution = $institution;
  }

}
