#!/usr/bin/php -d display_errors
<?php
error_reporting(E_ALL);
define('__ROOT__', dirname(dirname(__FILE__))); 
//define our file path as the directory this file is in,
// which prevents the "file not found" error if we call the
// file from outside its director (if the current working
// directory is not the file's directory. 


/**
 *	To make our code more readable and modular, we often want to use php's object-oriented features,
 *   but mostly to organize our procedures.  It is not uncommon to create only one instance of and
 *   object in php.
 *
 *  The convention is to place classes in their own files, with lower-case file names, but upper-case class names.
 *
 *	WARNING: Windows "sometimes" enforces case, and other times does not.  Linux always enforces case, and Mac
 *		usually does.
 */

require_once('caesar.php'); //the Caesar class is in this file, in the same directory as my php file.  See https://www.php.net/manual/en/function.require-once.php

$myCaesar = new Caesar;

print($myCaesar->shift_key . "\n");

$myplaintext = "You never close your eyes, anymore, when I kiss your lips.";
$myciphertext = $myCaesar->encrypt($myplaintext);
print($myciphertext . "\n");

$yourplaintext = $myCaesar->decrypt($myciphertext);
print($yourplaintext . "\n");

if (strtolower($myplaintext) == $yourplaintext) {
	print( "Righteous : \033[0;32mPASSED\033[0m\n\n" );
} else { 
	print( "Righteous : \033[0;31mFAILED\033[0m\n\n" ); 
}

$myCaesar->shift_key = 6;

$myplaintext = "We can dance if we want to.  We can leave your friends behind.\nBecause your friends don't dance, and if they don't dance, \nWell, they're no friends of mine.";
$myciphertext = $myCaesar->encrypt($myplaintext);
print($myciphertext . "\n");

$yourplaintext = $myCaesar->decrypt($myciphertext);
print($yourplaintext . "\n");

if (strtolower($myplaintext) == $yourplaintext) {
	print( "Men Without Hats : \033[0;32mPASSED\033[0m\n\n" );
} else { 
	print( "Men Without Hats : \033[0;31mFAILED\033[0m\n\n" ); 
}
