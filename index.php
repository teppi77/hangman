<?php

session_start();

require "vendor/autoload.php";

use Hangman\Client\CLIClient;
use Hangman\Client\HTMLClient;
use Hangman\Game\HangmanGame;
use Hangman\Game\SumGame;
use Hangman\Game\Player;

// Clear any Session variables if we have a game restart.
if (!empty($_GET['restart'])) {
  $_SESSION = array();
}

$client = null;
$player = new Player(5);
$game = new SumGame($player);

if (php_sapi_name() === 'cli') {
  $client = new CLIClient($player, $game);
} else {
  $client = new HTMLClient($player, $game);
}
$client->start();
?>
