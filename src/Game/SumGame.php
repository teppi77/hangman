<?php 

namespace Hangman\Game;

use Hangman\Game\Game;

class SumGame implements Game{
  
  private $title = 'Sum game';
  
  private $sum = 0;
  private $sum_x = 0;
  private $sum_y = 0;
  private $isFinished = FALSE;
  private $userSum = 0;
  private $player = null;
  
  public function __construct($player) {
    $this->player = $player;
    
    $this->sum_x = rand(0,100);
    $this->sum_y = rand(0,100);
    
    $this->guessedSum = 0;
    $this->sum = $this->sum_x + $this->sum_y;
    
    $this->loadStateFromSession();
  }
  
  public function getTitle() {
    return $this->title;
  }
  
  public function getPossibleUserInputElements() {
    return array(
      'sum' => array(
        'label' => 'What is the result',
      ));
  }
  
  public function evaluateUserInputs($userInputs) {
    
    $this->userSum = $this->sanitizeUserInput($userInputs['sum']);
    
    if ($this->userSum !== $this->sum) {
      $this->player->reduceLive();
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
        'label' => 'The correct sum is',
        'value' => $this->sum,
      );
    } else {
      // Provide the current UI Elements
      $gameUIElements = array(
        'sum' => array(
          'label' => 'What is the result of ',
          'value' => $this->sum_x . ' + ' . $this->sum_y,
        ),
      );
    }
    return $gameUIElements;
  }
  
  /**
   * Saves the current state of the game to the session.
   */
  public function saveStateToSession() {
    $_SESSION['sum'] = $this->sum;
    $_SESSION['sum_x'] = $this->sum_x;
    $_SESSION['sum_y'] = $this->sum_y;
    $_SESSION['userSum'] = $this->userSum;
    $_SESSION['isFinished'] = $this->isFinished;
    $_SESSION['lives'] = $this->player->livesLeft();
  }

  /**
   * Loads a previous state from the session
   */
  public function loadStateFromSession() {
    
    // Unset session if request was not a post request.
    if (empty($_POST)) {
      $_SESSION = array();
    }
    
    var_dump($_SESSION);
    
    // Load class properties from the session.
    if (isset($_SESSION['isFinished'])) {
      if ($_SESSION['isFinished']) {
        // Load the Gamestate from the session
        $this->sum = $_SESSION['sum'];
        $this->sum_x = $_SESSION['sum_x'];
        $this->sum_y = $_SESSION['sum_y'];
        $this->userSum = $_SESSION['userSum'];
      } else {
        $_SESSION = array();
      }
    }
  }

  /**
   * @return Boolean isFinished
   */
  public function isFinished() {
    return $this->isFinished;
  }
  
  public function isSolved() {
    $isSolved = TRUE;
    if ($this->userSum !== $this->sum) {
      $isSolved = FALSE;
    }
    return $isSolved;
  }
  
  public function sanitizeUserInput($userInput) {
    return (int)$userInput;
  }
}