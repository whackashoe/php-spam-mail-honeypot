<?php
/* Copyright (C) 2013 Jett LaRue
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

class honeypot {
	private $hp = array();

	//don't change these, they are supposed to look real
	public function __construct() {
        //php now requires a set timezone
        if(ini_get('date.timezone') == "")
            if(@date_default_timezone_get() == "UTC" || @date_default_timezone_get() == "")
                date_default_timezone_set('UTC');

		array_push($this->hp, md5("username" . (date('z')-234)));
		array_push($this->hp, md5("email" . (date('z')-234)));
		array_push($this->hp, md5("message" . (date('z')-234)));
		array_push($this->hp, md5("comments" . (date('z')-234)));
		array_push($this->hp, md5("phone" . (date('z')-234)));
		array_push($this->hp, md5("name" . (date('z')-234)));
		array_push($this->hp, md5("address" . (date('z')-234)));
		array_push($this->hp, md5("name" . (date('z')-234)));
	}

	//use make a bunch of hidden crap
	public function spew() {
		$h = '<style scoped>.redihtoph{display:none!important;}</style>';
		foreach ($this->hp as $v) {
			$h .= '<input type="text" name="'.$v.'" value="" class="redihtoph">';
		}
		return $h;
	}

	//encodes post name
	public function encode($name) {
		return md5($name . date('z'));
	}

	//checks hp vars haven't been touched by bot
	public function verify() {
		foreach ($this->hp as $v) {
			if(!empty($_POST[$v])) return false;
		}
		return true;
	}
}
?>
