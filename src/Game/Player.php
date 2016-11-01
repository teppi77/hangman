<?php 

namespace Hangman\Game;

class Player
{
  private $lives = 0;
  // Session ID.
  private $id = '';
  
  function __construct($lives) {
    if (isset($_SESSION['isFinished'])) {
      if (!$_SESSION['isFinished']) {
        $lives = $_SESSION['lives'];
      }
    }
    $this->lives = $lives;
  }
  
  public function reduceLive() {
    $this->lives--;
  }
  
  public function livesLeft() {
    return $this->lives;
  }
  
  public function isDead() {
    if ($this->lives > 0) {
      return FALSE;
    } else {
      return TRUE;
    }
  }
}

