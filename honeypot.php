<?php
class honeypot {
	public $hp = array();

	//don't change these, they are supposed to look real
	public function __construct() {
		array_push($this->hp, md5("username" . (date('z')-234)));
		array_push($this->hp, md5("email" . (date('z')-234)));
		array_push($this->hp, md5("message" . (date('z')-234)));
		array_push($this->hp, md5("comments" . (date('z')-234)));
		array_push($this->hp, md5("phone" . (date('z')-234)));
		array_push($this->hp, md5("name" . (date('z')-234)));
	}

	//use make a bunch of hidden crap
	public function spew() {
		$h = '<style>.redihtoph{display:none;}</style>';
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