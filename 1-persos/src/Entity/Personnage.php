<?php

namespace App\Entity;

class Personnage
{
  public $name;
  public $age;
  public $sexe;
  public $carac = [];
  public static $personnages = [];

  public function __construc($nom, $age, $sexe, $carac)
  {
    $this->nom = $nom;
    $this->age = $age;
    $this->sexe = $sexe;
    $this->carac = $carac;
    self::$personnages[] = $this;
  }

  public static function creerPersonnages()
  {
    $p1 = new Personnage("Marc", 25, true, [
      'force' => 3,
      'agi' => 2,
      'intel' => 3
    ]);
    $p2 = new Personnage("Milo", 32, true, [
      'force' => 5,
      'agi' => 1,
      'intel' => 2
    ]);
    $p3 = new Personnage("Tya", 25, false, [
      'force' => 1,
      'agi' => 2,
      'intel' => 5
    ]);
  }
}
