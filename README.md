CodeChallenge
=============

Introduction
------------
The challenge is a brute force game to decrypt the HASH based on an example of Anagram based and a Dictionary. The first steps consists of a funny tricks where you start collecting as much information
as possible, therefore you start discovering all the hidden messages, even thought MD5 is considered as a dead hashing method using crackers tools doesn't help a lot to decrypt the secret phrase. 

The algorithm consists on several steps to unveil the secret phrase, get the list of all the words, filter them from special chars, words with inexistent chars according to the Anagram, and then 
the guessing game is on. Running the script in a list of 70 000 words can result in a very long execution time that probably will end-up with 504 Gateway timeout or execution time exceeded from the PHP server. 
After applying the different filters we end up with a list of ~1659 words. The final step consists of combining the words, adding the space SALT and decrypt it using the MD5 function.

Requirements
------------
- Docker
- Docker compose
- Composer
- PHPDoc

Installation
------------
Run containers and install dependencies

    docker-compose build
    docker-compose up
    composer install
    composer dump-autoload --optimize

Usage
------------
It is recommended to launch the script from the command line due to execution time. You can also launch it from the browser, make sure you add trustpilot.dev to your hosts file.

    php src/main.php

Documentation
-------------
To generate documentation

    phpdoc run -d /PATH_TO_PROJECT/src -t /PATH_TO_PROJECT/docs/ --template responsive