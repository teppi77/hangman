<?php 

namespace Hangman\Game;

interface Game
{
  public function __construct($player);
  
  public function getTitle();
  
  public function getPossibleUserInputElements();
  
  public function evaluateUserInputs($userInputs);
  
  public function getGameUIElements();
  
  public function saveStateToSession();
  
  public function loadStateFromSession();

  public function isFinished();
  
  public function isSolved();
  
  public function sanitizeUserInput($userInput);
}