<?php

require "vendor/autoload.php";

use Hangman\Game\Game;
use Hangman\Game\Player;

$player = new Player(5);
$game = new Game($player);

$game->setSecretWord('Cameleon');
while(!$game->isFinished()) {
  
}

/*
$secret_word = explode(' ', 'C a m e l e o n');
$wrong_guesses = array();
$guessed_word = array();
$lifes = 5;
$game_running = TRUE;

// Initialize guessed word
foreach ($secret_word as $secret_word_character) {
  $guessed_word[] = '_';
}

while($game_running) {
  system('clear');
  print("--------------------\n");
  print("| The hangman game |\n");
  print("--------------------\n");
  print("You have $lifes lifes left.\n");
  if (!empty($wrong_guesses)) {
    print('Already chosen wrong letters: ' . implode(', ', $wrong_guesses) . "\n");
  }

  foreach($guessed_word as $guessed_word_character) {
    print($guessed_word_character . ' ');
  }
  print("\n\n");
  $user_character = readline("What is your next guess: ");
  if (strlen($user_character) > 0) {
    $user_character = substr($user_character, 0, 1);
  }
  $found_character = FALSE;

  $found_character = search_character_secretword($user_character, $guessed_word, $secret_word);

  // Do not penalty user for chosing a wrong letter multiple times.
  if (in_array(strtoupper($user_character), $wrong_guesses)) {
    $found_character = TRUE;
  }

  if (!$found_character) {
    $lifes--;
    if(!in_array(strtoupper($user_character), $wrong_guesses)) {
      $wrong_guesses[]= strtoupper($user_character);
    }
  }
  if ($lifes == 0) {
    print('Sorry, you lost!');
    $game_running = FALSE;
  }
  // Check if player won the game
  if (implode($secret_word) == implode($guessed_word)) {
    system('clear');
    print('The correct answer is:' . implode(' ', $secret_word) . "\n");
    print("Congratulations! You won the game!\n");
    $game_running = FALSE;
  }
}

function search_character_secretword($character, &$guessed_word, $secret_word) {
  $found_character = FALSE;
  if (in_array(strtolower($character), $secret_word) || in_array(strtoupper($character), $secret_word)) {
    foreach($secret_word as $secret_word_character_index => $secret_word_character) {
      // Check if the entered character exists in the secret word
      if(strtolower($character) == strtolower($secret_word[$secret_word_character_index])) {
        $guessed_word[$secret_word_character_index] = $secret_word[$secret_word_character_index];
        $found_character = TRUE;
      }
    }
  }
  return $found_character;
}
*/