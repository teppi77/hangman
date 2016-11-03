<?php 

namespace Hangman\Game;

use Hangman\Game\GameState;

class HangmanGameState implements GameState{
  
  private $title = 'Hangman';
  
  private $secretWord = '';
  private $isFinished = FALSE;
  private $player = null;
  private $guessedCharacters = array();
  
  public function __construct($player) {
    $this->player = $player;
    
    // TODO: Provide some means to get other words .. 
    $this->secretWord = str_split('Cameleon');
    
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
  
  public function getTitle() {
    return $this->title;
  }
  
  public function getPossibleUserInputElements() {
    return array(
      'guess' => array(
        'label' => 'Your guess',
      ));
  }
  
  public function submitUserInputs($userInputs) {
    $character = $userInputs['guess'];
    if (!in_array($character, $this->guessedCharacters) && !in_array($character, $this->secretWord)) {
      $this->player->reduceLive();
    }
    if(!in_array($character, $this->guessedCharacters)) {
      $this->guessedCharacters[] = $character;
    }
    if ($this->player->isDead() || $this->isSolved()) {
      $this->isFinished = TRUE;
    }
  }
  
  public function getGameUIElements() {
    $gameUIElements = array();
    if ($this->isFinished) {
      if ($this->isSolved()) {
         $gameUIElements['won'] = array(
          'label' => '',
          'value' => 'Yay! You won!',
        );
      } else {
        $gameUIElements['lost'] = array(
          'label' => '',
          'value' => 'Oh no you lost!',
        );
      }
      $gameUIElements['secret_word'] = array(
        'label' => 'The word we were looking for was',
        'value' => implode(' ', $this->secretWord),
      );
    } else {
      // Provide the current UI Elements
      $gameUIElements = array(
        'secret_word' => array(
          'label' => 'The word we\'re looking for',
          'value' => $this->getMaskedSecredWord(),
        ),
        'guesses' => array(
          'label' => 'Your guesses so far',
          'value' => implode(', ', $this->guessedCharacters),
        ),
        'lives' => array(
          'label' => 'Lives left',
          'value' => $this->player->livesLeft(),
        )
      );
    }
    return $gameUIElements;
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
   * @return Boolean isFinished
   */
  public function isFinished() {
    return $this->isFinished;
  }
  
  public function isSolved() {
    $isSolved = TRUE;
    foreach($this->secretWord as $secretWordCharacter) {
      if (!in_array(strtolower($secretWordCharacter), $this->guessedCharacters)) {
        $isSolved = FALSE;
      }
    }
    return $isSolved;
  }
  
  private function getMaskedSecredWord() {
    $maskedSecretWord = '';
    foreach($this->secretWord as $secretWordCharacter) {
      if (!in_array(strtolower($secretWordCharacter), $this->guessedCharacters)) {
        $maskedSecretWord .= '_ ';
      } else {
        $maskedSecretWord .= strtoupper($secretWordCharacter) . ' ';
      }
    }
    return $maskedSecretWord;
  }
}