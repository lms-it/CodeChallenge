<?php
/**
 *
 * Trustpilot Backend Challenge
 *
 * @package  TrustpilotChallenge
 * @author   Mohamed Salem Lamiri <mohamed.salem.lamiri@gmail.com>
 * @access   public
 * @see      https://github.com/lms-it
*/

require_once  '../vendor/autoload.php';
use Anagram\Anagram;


define("ANAGRAM", "poultry outwits ants");
define("ANAGRAMSIZE", 18);

$anagram = new Anagram();
echo $anagram->findSecretPhrase();
