<?php

/**
 * Meta robots excluder plugin for ViewGit.
 *
 * Adds a "<meta name="robots" ... /> field to the header.
 * This prevents robots from following your links and getting all confused.
 * Written in 15 panicked minutes after Googlebot tried to download
 * all revisions of all of my files.
 *
 * Set $conf['robots'] to the type of exclusion you want
 * (noindex, nofollow is good)
 *
 * @author Robert Mead <rmead@rmead.com>
 */


class RobotsPlugin extends VGPlugin
{
	function __construct() {
		global $conf;
		if (isset($conf['robots'])) {
			$this->register_hook('header');
		}
	}

	function hook($type) {
		if ($type == 'header') {
			global $conf;
			$this->output("\t<meta name=\"robots\" content=\"$conf[robots]\"/>");
		}
	}
}

