<?php 

namespace Hangman\Game;

class GameState
{
  private $secretWord = '';
  private $isFinished = FALSE;
  private $player = null;
  private $guessedCharacters = array();
  
  function __construct($player) {
    $this->player = $player;
    
    // Load class properties from the session.
    if (isset($_SESSION['isFinished'])) {
      if (!$_SESSION['isFinished']) {
        // Load the Gamestate from the session
        $this->secretWord = $_SESSION['secretWord'];
        $this->guessedCharacters = $_SESSION['guessedCharacters'];
      } else {
        $_SESSION = array();
      }
    }
  }
  
  public function addGuess($character) {
    if (!in_array($character, $this->guessedCharacters) && !in_array($character, $this->secretWord)) {
      $this->player->reduceLive();
    }
    if(!in_array($character, $this->guessedCharacters)) {
      $this->guessedCharacters[] = $character;
    }
    if ($this->player->isDead()) {
      $this->isFinished = TRUE;
    }
  }
  
  /**
   * Saves the current state of the game to the session.
   */
  public function saveStateToSession() {
    $_SESSION['secretWord'] = $this->secretWord;
    $_SESSION['guessedCharacters'] = $this->guessedCharacters;
    $_SESSION['isFinished'] = $this->isFinished;
    $_SESSION['lives'] = $this->player->livesLeft();
  }
  
  /**
   * @param string $word The secret word to be guessed by Player.
   * @return void
   */
  public function setSecretWord($word) {
    $this->secretWord = str_split($word);
  }

  
  /**
   * @return Boolean isFinished
   */
  public function isFinished() {
    return $this->isFinished;
  }
}