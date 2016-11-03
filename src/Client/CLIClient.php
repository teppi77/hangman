<?php

namespace Hangman\Client;

class CLIClient extends Client
{
  public function __construct($player, $gameState){
    $this->player = $player;
    $this->gameState = $gameState;
  }
  
  public function start() {
    while(!$this->gameState->isFinished()) {
      $this->output();
      $userInputs = array();
      foreach($this->gameState->getPossibleUserInputElements() as $userInputElementID => $userInputElementConfiguration) {
          $userInputs[$userInputElementID] = $this->sanitizeUserInput(readline($userInputElementConfiguration['label'] . ': '));
      }
      if (!empty($userInputs)) {
        $this->gameState->submitUserInputs($userInputs);
      }
    }
    
  }
  
  public function output() {
    print $this->gameState->getTitle() . PHP_EOL;
    $gameUiElements = $this->gameState->getGameUIElements();
    foreach($gameUiElements as $gameUiElement) {
      print $gameUiElement['label'] . (empty($gameUiElement['label']) ? '' : ' : ') . $gameUiElement['value'] . PHP_EOL;
    }
  }
}