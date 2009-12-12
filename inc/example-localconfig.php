<?php
/** @file
 * Example localconfig.php. See config.php for more information.
 */

// This is the only mandatory setting
$conf['projects'] = array(
	'foo' => array('repo' => '/home/user/projects/foo/.git'),
	'bar' => array(
		'repo' => '/home/user/projects/foo/.git',
		'description' => 'Optional overridden description, otherwise it is taken from .git/description'
	),
);

// A bit sorter datetime format: YY-MM-DD HH:MM
$conf['datetime'] = '%y-%m-%d %H:%M';

// Extra security
$conf['allow_checkout'] = false;

