<?php

/**
 * Copyright (c) 2022 Brandon Jordan
 */

// Get random 8 character word
$c = curl_init();
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_URL, "https://random-word-api.herokuapp.com/word?length=8");
$response = curl_exec($c);
curl_close($c);
$word = json_decode($response, true)[0];

// Pick a special character
$special_chars = array("!", "@", "#", "?");
shuffle($special_chars);
$special_char = $special_chars[0];

// Pick 2 random numbers
$random_numbers = [rand(1, 9), rand(1, 9)];

// Randomly capitalize 2 random characters in the random word
$word_len = strlen($word);
$rand_letter1 = rand(0, $word_len);
$rand_letter2 = rand(0, $word_len);
$i = 0;
$final_word = '';
foreach (str_split($word) as $letter) {
	if ($i === $rand_letter1 || $i === $rand_letter2) {
		$final_word .= strtoupper($letter);
	} else {
		$final_word .= $letter;
	}
	++$i;
}

// Output password
$password = $final_word . implode("", $random_numbers) . $special_char;
echo "$password\n";
