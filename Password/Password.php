<?php
/**
 * Password Generator
 *
 * Simple password generator to help you generate
 * secure passwords.
 *
 * Changelog v1.0:
 * - first version ;)
 *
 * Bugs:
 * - If you set passwords longer than is range
 * of characters while having enabled unique_chars,
 * than it will do nothing good.
 *
 * Issues:
 * - way to get unique characters in password
 * can be improved. It's not the best solution
 * I think and sometimes cause slower load of
 * script.
 *
 * Usage:
 * - See example.php
 *
 * Notes:
 * - I'm now about to find a nice way to ensure
 * that password contains at least one character
 * from each option enabled.
 * - Also need to find a way how to keep some
 * security of code in unique_chars vs limited
 * count of chars range.
 * - Using special chars is disabled for default
 * because some systems, apps and websites don't
 * allow using them and also ppl in different
 * countries may not know how to make some of
 * them...
 *
 * Copyright 2007-2009, Daniel Tlach
 *
 * Licensed under GNU GPL
 *
 * @copyright		Copyright 2007-2009, Daniel Tlach
 * @link			http://www.danaketh.com
 * @version			1.0
 * @license			http://www.gnu.org/licenses/gpl.txt
 */
class Password
{
	private $data = array(
						'length' => 8, // length of the password
						'count' => 5, // number of passwords to generate
						'unique_chars' => TRUE, // every char can be presented only once (case-sensitive)
						'passwd' => array(), // passwords storage
						'use_lower_case' => TRUE, // use lower-case chars
						'use_upper_case' => TRUE, // use upper-case chars
						'use_digits' => TRUE, // use numbers
						'use_special' => FALSE, // use special chars
					);
	private $range = array(
					);

	// {{{ __construct
	/**
	* Constructor
	*
	* @author		Daniel Tlach <mail@danaketh.com>
	*/
	function __construct(  )
	{
		// lower-case [a-z] chars
		$this->range['lc'] = range('a', 'z');
		// upper-case [A-Z] chars
		$this->range['uc'] = range('A', 'Z');
		// digits [0-9]
		$this->range['d'] = range('0', '9');
		// special chars
		// use more if you wish - I used only these because
		// a lost of ppl don't know how to make ^ or ~ and
		// also quotes can be tricky
		$this->range['s'] = array('*', '_', '-', '?', '!', '+', '#', '@', ';', ':');
	}
	// }}}

	// {{{ __set
	/**
	* Setter
	*
	* @author		Daniel Tlach <mail@danaketh.com>
	*/
	public function __set( $name, $value )
	{
		if (array_key_exists($name, $this->data)) {
			$this->data[$name] = $value;
		}
	}
	// }}}

	// {{{ __get
	/**
	* Getter
	*
	* @author		Daniel Tlach <mail@danaketh.com>
	*/
	public function __get( $name )
	{
		if (array_key_exists($name, $this->data)) {
			return $this->data[$name];
		}
	}
	// }}}

	// {{{ passGen
	/**
	* Start generator
	*
	* @author		Daniel Tlach <mail@danaketh.com>
	* @access 		public
	* @return 		void
	*/
	public function passGen()
	{
		$work_range = array(); // this will be range of chars we'll be working with
		$this->data['passwd'] = array(); // reset password storage

		// lower-case [a-z] chars
		if ($this->data['use_lower_case'] === TRUE) {
			$work_range[] = &$this->range['lc'];

		}
		// upper-case [A-Z] chars
		if ($this->data['use_upper_case'] === TRUE) {
			$work_range[] = &$this->range['uc'];
		}
		// digits [0-9]
		if ($this->data['use_digits'] === TRUE) {
			$work_range[] = &$this->range['d'];
		}
		// special chars
		if ($this->data['use_special'] !== FALSE) {
			$work_range[] = &$this->range['s'];
		}

		// quit if we don't have any chars to generate password from
		if (empty($work_range)) {
			return FALSE;
		}
		//echo '<pre>'; print_r($work_range); echo '</pre>';

		$range = count($work_range)-1; // count character arrays
		$p = 0; // passwords counter

		// Generate "$this->date['count']" passwords
		while($p < $this->data['count'])	{

			$c = 0; // password chars counter
			$pass = NULL; // empty password variable

			// Generate password
			while($c < $this->data['length'])	{
				$pass .= $this->getChar($work_range, $range, $pass);
				$c++;
			} // while

			$this->data['passwd'][] = $pass;

			$p++;

		} // while

	}
	// }}}

	// {{{ getChar
	/**
	* Characted generator
	*
	* @author		Daniel Tlach <mail@danaketh.com>
	* @access 		private
	* @return 		string
	*/
	private function getChar( $charr, $range, $pass )
	{
		$index = mt_rand(0, $range);
		$wrindex = mt_rand(0, count($charr[$index])-1);
		$char = $charr[$index][$wrindex];
		$check_char = $char;
		if (in_array($char, $this->range['s'])) {
			$check_char = '\\'.$check_char;
		}
		if ($this->data['unique_chars'] === TRUE && ereg($check_char, $pass) !== FALSE && $this->data['length'] < 26)	{
			return $this->getChar($charr, $range, $pass);
		}
		else	{
			return $char;
		}
	}
	// }}}

	// {{{ destruct
	/**
	* Destructor
	*
	* @author		Daniel Tlach <mail@danaketh.com>
	*/
	function __destruct()
	{
		$this->data = array();
	}
	// }}}

}

?>