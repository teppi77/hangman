<?php

namespace Hangman\Client;

class HTMLClient implements Client
{
  private $game = null;
  private $player = null;
  
  public function __construct($player, $game){
    $this->player = $player;
    $this->game = $game;
  }
  
  /**
   * Specific logic for an HTML client.
   */
  public function start() {
    $userInputs = array();
    if (!$this->game->isFinished()) {
      foreach($this->game->getPossibleUserInputElements() as $userInputElementID => $userInputElementConfiguration) {
        if (!empty($_POST[$userInputElementID])) {
          $userInputs[$userInputElementID] = $_POST[$userInputElementID];
        }
      }
      if (!empty($userInputs)) {
        $this->game->evaluateUserInputs($userInputs);
        $this->game->saveStateToSession();
      }
    }
    $this->output();
  }
  
  /**
   * Prints out the application as HTML.
   */
  public function output() {
    $header = $this->game->getTitle();
    $gameUiElements = $this->game->getGameUIElements();
    $gameUIContent = '';
    $gameUserInputElements = $this->game->getPossibleUserInputElements();
    $userInputElements = '';
    $submit = '';
    $resetLink = '';
    if (!$this->game->isFinished()) {
      $submit = '<input type="submit" name="submit" />';
      foreach($gameUserInputElements as $gameUserInputElementID => $gameUserInputElement) {
        $userInputElements .= '<label for="' . $gameUserInputElementID . '">' . $gameUserInputElement['label'] . ':</label>
        <input type="text" name="' . $gameUserInputElementID . '" />';
      }
    }
    $resetLink = '<a href="/?restart=restart">Restart the game!</a>';
    foreach($gameUiElements as $gameUiElement) {
      $gameUIContent .= '<p>' . $gameUiElement['label'] . (empty($gameUiElement['label']) ? '' : ' : ') . $gameUiElement['value'] . '</p>';
    }
    
    $output = <<<EOF
    <html>
      <body>
        <h1>$header</h1>
        $gameUIContent
        <form action="/" method="post">
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

