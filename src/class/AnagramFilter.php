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

namespace AnagramFilter;
use Anagram\Anagram;

/**
 * AnagramFilter is a class used as an anonymous function to filter Anagrams
 */
class AnagramFilter {
    /**
     * @var int Anagram size
     */
    private $sizeUsed = 0;
    /**
     * @var string Anagram phrase
     */
    private $phrase = "";

    /**
     * Constructor
     * @param int $sizeUsed
     * @param string $phrase
     */
    function __construct($sizeUsed, $phrase) {
        $this->sizeUsed = $sizeUsed;
        $this->phrase = $phrase;
    }

    /**
     * Test if a valid anagram guess
     *
     * @param string Anagram guessed word
     * @return boolean
     * @access public
     */
    function isValid($word) {
        $anagram = new Anagram();

        if(!$anagram->isAnagram($this->phrase.$word, true)){
            return false;
        }
        return strlen($word) + $this->sizeUsed == ANAGRAMSIZE;
    }
}
