<?php

header( 'Content-Type: text/html; charset=utf-8' );

error_reporting(E_ALL);

include './Password.php'; // include library

$Password = new Password; // create object
$Password->length = 8; // set length of password (8 is default)
$Password->count = 5; // set count of passwords (5 is default)

/*
	Simple password, only from lower-case
	- we have to turn off unique_chars, use_upper_case
	  and use_digits. All of these options are enabled by
	  default.
*/
$Password->unique_chars = FALSE;
$Password->use_upper_case = FALSE;
$Password->use_digits = FALSE;
$Password->passGen();

echo "<pre>";
echo "<strong>Simple Passwords</strong>\n";
foreach($Password->passwd as $pass)	{
	echo "$pass\n";
}
echo "</pre>";

/*
	Better password, mixed from lower-case and upper case
	- because we disabled all options before, we now enable
	use_upper_case.
*/
$Password->use_upper_case = TRUE;
$Password->passGen();

echo "<pre>";
echo "<strong>Better Passwords</strong>\n";
foreach($Password->passwd as $pass)	{
	echo "$pass\n";
}
echo "</pre>";

/*
	Even better password, mixed from lower-case, upper case
	and digits
	- again, we now enable only use_digits.
*/
$Password->use_digits = TRUE;
$Password->passGen();

echo "<pre>";
echo "<strong>Even Better Passwords</strong>\n";
foreach($Password->passwd as $pass)	{
	echo "$pass\n";
}
echo "</pre>";

/*
	Secure password, mixed from lower-case, upper case
	and digits, with unique characters
	- again, we now enable only unique_chars.
*/
$Password->unique_chars = TRUE;
$Password->passGen();

echo "<pre>";
echo "<strong>Secure Passwords</strong>\n";
foreach($Password->passwd as $pass)	{
	echo "$pass\n";
}
echo "</pre>";

/*
	The best password, mixed from lower-case, upper case,
	digits and special chars, with unique characters
	- again, we now enable use_special.
*/
$Password->use_special = TRUE;
$Password->passGen();

echo "<pre>";
echo "<strong>The Best Passwords</strong>\n";
foreach($Password->passwd as $pass)	{
	echo "$pass\n";
}
echo "</pre>";

?>