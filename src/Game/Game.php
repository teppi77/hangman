<?php 

namespace Hangman\Game;

class Game
{
  private $secretWord = '';
  
  /**
   * @param string $word The secret word to be guessed by Player.
   * @return void
   */
  public function setSecretWord($word) {
    $this->secretWord = $word;
  }
}