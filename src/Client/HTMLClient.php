<?php

namespace Hangman\Client;

class HTMLClient extends Client
{
  private $gameState = null;
  private $player = null;
  
  public function __construct($player, $gameState){
    $this->player = $player;
    $this->gameState = $gameState;
  }
  
  /**
   * Specific logic for an HTML client.
   */
  public function start() {
    $userInputs = array();
    if (!$this->gameState->isFinished()) {
      foreach($this->gameState->getPossibleUserInputElements() as $userInputElementID => $userInputElementConfiguration) {
        if (!empty($_POST[$userInputElementID])) {
          $userInputs[$userInputElementID] = $this->sanitizeUserInput($_POST[$userInputElementID]);
        }
      }
      if (!empty($userInputs)) {
        $this->gameState->submitUserInputs($userInputs);
        $this->gameState->saveStateToSession();
      }
    }
    $this->output();
  }
  
  /**
   * Prints out the application as HTML.
   */
  public function output() {
    $header = $this->gameState->getTitle();
    $gameUiElements = $this->gameState->getGameUIElements();
    $gameUIContent = '';
    $gameUserInputElements = $this->gameState->getPossibleUserInputElements();
    $userInputElements = '';
    $submit = '';
    $resetLink = '';
    if (!$this->gameState->isFinished()) {
      $submit = '<input type="submit" name="submit" />';
      foreach($gameUserInputElements as $gameUserInputElementID => $gameUserInputElement) {
        $userInputElements .= '<label for="' . $gameUserInputElementID . '">' . $gameUserInputElement['label'] . ':</label>
        <input type="text" name="' . $gameUserInputElementID . '" />';
      }
    } else {
      $resetLink = '<a href="/">Restart the game!</a>';
    }
    foreach($gameUiElements as $gameUiElement) {
      $gameUIContent .= '<p>' . $gameUiElement['label'] . (empty($gameUiElement['label']) ? '' : ' : ') . $gameUiElement['value'] . '</p>';
    }
    
    $output = <<<EOF
    <html>
      <body>
        <h1>$header</h1>
        $gameUIContent
        <form action="" method="post">
          $userInputElements
          $submit
          $resetLink
        </form>
      </body>
    </html>
EOF;
    echo $output;
  }
}

