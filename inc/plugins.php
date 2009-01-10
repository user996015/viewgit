<?php

$plugin_actions = array(); // action -> plugin object
$plugin_hooks = array();

function call_hooks($type) {
	global $plugin_hooks;
	if (in_array($type, $plugin_hooks)) {
		foreach ($plugin_hooks[$type] as $class) {
			$class->hook($type);
		}
	}
}

/**
 * Base class plugins should extend. This defines the public, hopefully
 * somewhat static API plugins should be able to rely on.
 *
 * Plugins go to plugins/name/main.php and must contain a NamePlugin class.
 */
class VGPlugin
{
	/**
	 * Actions, hooks and other things must be initialized/registered here.
	 */
	function __construct() {

	}

	/**
	 * Called when a registered action is triggered.
	 */
	function action($action) {}

	/**
	 * Display the given template.
	 */
	function display_template($template, $with_headers = true) {
		if ($with_headers) {
			require 'templates/header.php';
		}
		require "$template";
		if ($with_headers) {
			require 'templates/footer.php';
		}
	}

	/**
	 * Called when a registered hook is triggered.
	 * 
	 * Hooks:
	 * header - before closing the head tag
	 * page_start - after body is opened
	 * footer - before closing the body tag
	 * pagenav - output() can be used to insert content into pagenav.
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

