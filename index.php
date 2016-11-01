<?php

session_start();

require "vendor/autoload.php";

use Hangman\Client\CLIClient;
use Hangman\Client\HTMLClient;

$client = null;

if (php_sapi_name() === 'cli') {
  $client = new CLIClient();
} else {
  $client = new HTMLClient();
}
$client->start();
?>
