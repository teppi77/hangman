<?php

namespace Hangman\Client;

use Hangman\Game\GameState;
use Hangman\Game\Player;

class HTMLClient extends Client
{
  private $gameState = null;
  
  /**
   * Specific logic for an HTML client.
   */
  public function start() {
    $player = new Player(5);
    $this->gameState = new GameState($player);
    $this->gameState->setSecretWord('Cameleon');
    
    if (!empty($_POST['guess'])) {
      $character = $this->sanitizeUserInput($_POST['guess']);
      $this->gameState->addGuess($character);
      $this->gameState->saveStateToSession();
    }
    $this->output();
  }
  
  /**
   * Prints out the application as HTML.
   */
  public function output() {
    $header = nl2br($this->getHeader());
    $str = <<<EOF
    <html>
      <body>
        <p>$header</p>
        <form action="" method="post">
          <label for="guess">Your guess:</label>
          <input type="text" name="guess" />
          <input type="submit" name="submit" />
        </form>
      </body>
    </html>
EOF;
    echo $str;
  }
}

