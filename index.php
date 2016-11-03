<?php

session_start();

require "vendor/autoload.php";

use Hangman\Client\CLIClient;
use Hangman\Client\HTMLClient;
use Hangman\Game\HangmanGameState;
use Hangman\Game\Player;

$client = null;
$player = new Player(5);
$gameState = new HangmanGameState($player);

if (php_sapi_name() === 'cli') {
  $client = new CLIClient($player, $gameState);
} else {
  $client = new HTMLClient($player, $gameState);
}
$client->start();
?>
