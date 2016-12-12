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

namespace Anagram;
use AnagramFilter\AnagramFilter;

/**
 * Anagram is the class that handel all the logic
 */
class Anagram{

    const FILEPATH = "/../dic/wordlist";
    const HASH     = "4624d200580677270a54ccff86b9610e";

    /**
     * Occurrence of each letter in the anagram
     * @var array
     */
    public $anagramOccurrences;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->anagramOccurrences = $this->getAnagramOccurrences();
    }

    /**
     * Find the secret phrase.
     *
     * @return string A message or the secret phrase
     * @access public
     */
    public function findSecretPhrase(){
        return $this->bruteForce($this->cleanList());
    }

    /**
     * Parse the file for words.
     *
     * @return array List of unique words
     * @access public
     */
    public function parseFile(){
        return array_values(array_unique(file(__DIR__.Anagram::FILEPATH , FILE_IGNORE_NEW_LINES)));
    }

    /**
     * This function will use $anagramOccurrences to filter parsed file.
     *
     * @return array List of filtered words
     * @access public
     */
    public function cleanList(){
        $this->anagramOccurrences = $this->getAnagramOccurrences();

        $cleanedWordList = array();
        foreach($this->parseFile() as $word) {
            /**
             * In order to reduce the complexity of the script(N^3), I added the test on strings length to reduce the list size
             * List size before this test ~1659, after ~~500
             * This significantly reduce the overall execution time
             * However an anagram could contain words of all sizes.
             */
            if($this->isAnagram($word) && (strlen($word) == 7 || strlen($word) == 4)){
                $cleanedWordList[] = strtolower($word);
            }
        }
        return $cleanedWordList;
    }

    /**
     * Split anagram to an array of letters and occurrences.
     *
     * @return array Array of letters and occurrences
     * @access public
     */
    function getAnagramOccurrences(){
        //Counts the number of occurrences of every byte-value, return ASCII
        foreach (count_chars(str_replace(' ', '', ANAGRAM), 1) as $i => $occurrences) {
            //Convert the ASCII code to the specific letter
            $anagram[chr($i)] = $occurrences;
        }
        return $anagram;
    }

    /**
     * Test if a word or a phrase is anagram.
     *
     * @param string @word Anagram word
     * @param boolean $isPhrase Indicate that the anagram is the full phrase
     * @return boolean
     * @access public
     */
    function isAnagram($word, $isPhrase = false)
    {
        for ($i = 0; $i < strlen($word); $i++) {
            if (array_key_exists($word[$i], $this->anagramOccurrences) && $occ = substr_count($word, $word[$i])) {
                if($isPhrase){
                    if ($this->anagramOccurrences[$word[$i]] != $occ) {
                        return false;
                    }
                }
                elseif ($this->anagramOccurrences[$word[$i]] < $occ) {
                    return false;
                }
            }
            else
                return false;
        }
        return true;
    }

    /**
     * Brute force the guessed phrase.
     *
     * @param array @$cleanedWordList Cleaned list of words
     * @return string A message or the secret phrase
     * @access public
     */
    public function bruteForce($cleanedWordList){
        foreach($cleanedWordList as $word){
            foreach($cleanedWordList as $word2){
                $sizeUsed = strlen($word)+strlen($word2);
                if($sizeUsed < ANAGRAMSIZE) {
                    $filteredList = array_filter($cleanedWordList, array(new AnagramFilter($sizeUsed, $word.$word2), 'isValid'));
                    if(isset($filteredList)){
                        foreach($filteredList as $word3){
                            echo "\nAnagram : ".$word." ".$word2." ".$word3."\n";

                            if (md5($word . " " . $word2 . " " . $word3) === $this::HASH){
                                return  "\n****** Secret Phrase Found : *****\n ".$word . " " . $word2 . " " . $word3."\n*************************\n ";
                            }
                        }
                    }
                }
            }
        }
        return "\nNothing found ..\n";
    }
}