<?php 

namespace Hangman;

class Game
{
  private $secretWord = '';
  private $isFinished = FALSE;
  private $player = null;
  
  function __construct($player) {
    $this->player = $player;
  }
  
  /**
   * @param string $word The secret word to be guessed by Player.
   * @return void
   */
  public function setSecretWord($word) {
    $this->secretWord = $word;
  }
  
  /**
   * @return Boolean isFinished
   */
  public function isFinished() {
    return $this->isFinished;
  }
}