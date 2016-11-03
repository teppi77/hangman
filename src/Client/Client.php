<?php

namespace Hangman\Client;

abstract class Client
{
  function sanitizeUserInput($char) {
    if (strlen($char) > 0) {
      $char = strtolower(substr($char,0,1));
      return $char;
    } else {
      return ' ';
    }
  }
}

