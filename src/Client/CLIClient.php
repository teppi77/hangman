<?php

namespace Hangman\Client;

class CLIClient extends Client
{
  public function start() {
    $this->output();
    $guessedChar = readline('Your guess');
    $client->makeGuess($guessedChar);
  }
  
  public function output() {
    print $this->getHeader();
  }
}