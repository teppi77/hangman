<?php 

namespace Hangman\Game;

interface GameState
{
  public function __construct($player);
  
  public function getTitle();
  
  public function getPossibleUserInputElements();
  
  public function submitUserInputs($userInputs);
  
  public function getGameUIElements();
  
  public function saveStateToSession();

  public function isFinished();
  
  public function isSolved();
}