<?php

class HelloPlugin extends VGPlugin
{
	function __construct() {
		global $conf;
		if (isset($conf['hello'])) {
			$this->register_action('hello');
			$this->register_hook('pagenav');
		}
	}

	function action($action) {
		$this->output("Hello world!");
	}

	function hook($type) {
		if ($type == 'pagenav') {
			$this->output(" | <a href=\"". makelink(array('a' => 'hello')) ."\">Hello</a> ");
		}
	}
}

