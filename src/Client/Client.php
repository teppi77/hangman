<?php

namespace Hangman\Client;

use Hangman\Game\Player;

abstract class Client
{ 
  function getHeader() {
    $header = <<<EOF
--------------------------
The Classic Hangman Game
--------------------------
EOF;
    return $header;
  }
  
  function sanitizeUserInput($char) {
    if (strlen($char) > 0) {
      $char = strtolower(substr($char,0,1));
      return $char;
    } else {
      return ' ';
    }
  }
}

