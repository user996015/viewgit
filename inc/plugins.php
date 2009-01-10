<?php

$plugin_actions = array(); // action -> plugin object
$plugin_hooks = array();

function call_hooks($type) {
	global $plugin_hooks;
	foreach ($plugin_hooks as $type => $classes) {
		foreach ($classes as $class) {
			$class->hook($type);
		}
	}
}

/**
 * Base class plugins should extend. This defines the public, hopefully
 * somewhat static API plugins should be able to rely on.
 */
class VGPlugin
{
	function __construct() {

	}

	/**
	 * Called when a registered action is triggered.
	 */
	function action($action) {}

	/**
	 * Called when a registered hook is triggered.
	 */
	function hook($type) {}

	/**
	 * Can be used to output xhtml.
	 */
	function output($xhtml) {
		echo($xhtml);
	}

	/**
	 * Registers the given action for this plugin.
	 */
	function register_action($action) {
		global $plugin_actions;
		$plugin_actions[$action] = $this;
	}

	function register_hook($type) {
		global $plugin_hooks;
		$plugin_hooks[$type][] = $this;
	}
}

