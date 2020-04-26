<?php

namespace App\Entity;

class Armes
{
  private $nom;
  private $description;
  private $degat;

  public static $armes = [];

  public function __construct($nom, $description, $degat)
  {
    $this->nom = $nom;
    $this->description = $description;
    $this->degat = $degat;
    self::$armes[] = $this;
  }

  public function getNom()
  {
    return $this->nom;
  }
  public function getDescription()
  {
    return $this->description;
  }
  public function getDegat()
  {
    return $this->degat;
  }

  public function setNom($nom)
  {
    $this->nom = $nom;
    return $this;
  }

  public function setDescription($description)
  {
    $this->description = $description;
    return $this;
  }

  public function setDegat($degat)
  {
    $this->degat = $degat;
    return $this;
  }

  public static function creerArme()
  {
    new Armes("épée", "Une superbe épée tranchante", 10);
    new Armes("hache", "Un arme ou un outils", 15);
    new Armes("arc", "Une arme à distance", 7);
  }

  public static function getArmeParNom($nom)
  {
    foreach (self::$armes as $arme) {
      if (strtolower(str_replace('é', 'e', $arme->nom)) === $nom) {
        return $arme;
      }
    }
  }
}
