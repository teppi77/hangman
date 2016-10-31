<?php 

namespace Hangman;

class Player
{
  private $lifes = 0;
  
  function __construct($lifes) {
    $this->lifes = $lifes;
  }
  
  public function boolean hasLifesLeft() {
    if ($this->lifes > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
}

