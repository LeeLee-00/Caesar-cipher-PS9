#!/usr/bin/php -d display_errors
<?php

class Caesar {
	public static $numbersToLetters = array(
	0 	=> 'A',
	1 	=> 'B',
	2 	=> 'C',
	3 	=> 'D',
	4 	=> 'E',
	5 	=> 'F',
	6 	=> 'G',
	7 	=> 'H',
	8	=> 'I',
	9 	=> 'J',
	10 	=> 'K',
	11 	=> 'L',
	12	=> 'M',
	13	=> 'N',
	14	=> 'O',
	15	=> 'P',
	16	=> 'Q',
	17	=> 'R',
	18	=> 'S',
	19	=> 'T',
	20	=> 'U',
	21  => 'V',
	22	=> 'W',
	23  => 'X',
	24  => 'Y',
	25	=> 'Z'
	);
	
	public static $lettersToNumbers = array(
	'A'	=> 0,
	'B'	=> 1,
	'C' => 2,
	'D'	=> 3,
	'E'	=> 4,
	'F'	=> 5,
	'G' => 6,
	'H'	=> 7,
	'I' => 8,
	'J'	=> 9,
	'K'	=> 10,
	'L'	=> 11,
	'M'	=> 12,
	'N'	=> 13,
	'O'	=> 14,
	'P'	=> 15,
	'Q'	=> 16,
	'R'	=> 17,
	'S'	=> 18,
	'T'	=> 19,
	'U'	=> 20,
	'V' => 21,
	'W'	=> 22,
	'X' => 23,
	'Y' => 24,
	'Z'	=> 25
	);




	/**
	 * The shift 
	 */
	public $shift_key = 6;

	/**
	 * Encrypts the plaintext using the shift key, and returns the ciphertext (in all caps).
	 */
	public function encrypt($plaintext) {
		//Capitalize all the characters
		$plaintext = strtoupper($plaintext);  // see https://www.php.net/manual/en/function.strtoupper.php
		//convert the string to an array, and then loop over the 
		$plaintext = str_split ($plaintext); //see https://www.php.net/manual/en/function.str-split.php
												//also see https://www.php.net/manual/en/function.explode.php
		
		//var_dump($plaintext); //Debug code  uncomment to see the array
		
		$cyphertext = array(); //create an empty array for our cyphertext
		
		//temporary variables for our script.  This is inelegant, but easy to follow.
		$tmp_plain_num = 0;
		$tmp_crypt_num = 0;
		foreach ($plaintext as $char) {
			//check to make sure we have a letter.  If we do not, just stick it in the cyphertext unencrypted.
			if(ctype_alpha($char)) {
				$tmp_plain_num = self::$lettersToNumbers[$char]; //gets the number
				/**
				 *	In php, mod takes precedence over addition, so we need parenthesis.  What would happen without them?
				 */
				$tmp_crypt_num = ($tmp_plain_num + $this->shift_key) % 26; //  See https://www.php.net/manual/en/language.operators.precedence.php for php's PEMDAS
				
				/**
				 *	In php (as opposed to some other languages), we can append an element to the end of an array 
				 *   by simply leaving the index empty.
				 */
				$cyphertext[] = self::$numbersToLetters[$tmp_crypt_num]; //encrypt the letter, and append it to the array.
			} else {
				$cyphertext[] = $char; //stick the non-letter in.
			}
		}
		
		//var_dump($cyphertext); //Debug code  Uncomment to see the array
		
		$cyphertext = implode($cyphertext); //convert back to a string.  See https://www.php.net/manual/en/function.implode.php
		
		return($cyphertext);
	}
	

	/*
	Lee J Noel
	3/12/2021
	Discrete math PS9
	*/
	public function decrypt($cyphertext) { // the decrypt function.
		$plaintext = strtoupper($cyphertext);	// caps the Characters.
		$plaintext = str_split($plaintext);		// converts the string to an array.
		
		
		//var_dump($plaintext); //Debug code  uncomment to see the array
		
		$cyphertext = array(); //creates an empty arary for our function
		
		//temporary variables for our script.  This is inelegant, but easy to follow.
		$tmp_cipher_num = 0;	// temp variable 1
		$tmp_decrypt_num = 0;	// temp variable 2
		foreach ($plaintext as $char) {		//  the for loop to make sure we have letters 
			
			if(ctype_alpha($char)) {
				$tmp_cipher_num = self::$lettersToNumbers[$char]; // gets the letters
				
				$tmp_decrypt_num = ($tmp_cipher_num - $this->shift_key + 26) % 26; // Doing the caculations to figure out which Letter Matched which number.
				
				
				$cyphertext[] = self::$numbersToLetters[$tmp_decrypt_num]; //encrypt the letter, and append it to the array.
			} else {
				$cyphertext[] = $char; //stick the non-letter in.
			}
		}
		
		//var_dump($cyphertext); //Debug code  Uncomment to see the array
		
		$cyphertext = implode($cyphertext); 	//converts it back into a string.
		$plaintext = strtolower($cyphertext);	// Lower case the characters

	
	
		return ($plaintext);	// returns the text.
	}
}
// end of program