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
		'www' => 'http://www.google.com', # optional
	),
);

// $conf['projects'] can also be built up programmatically
// for example the following can be used to translate gitolite's
// projects.list (intended for gitweb) for viewgit

/*
$projects_list_file = "/opt/git/projects.list";
$repo_home = "/opt/git/repositories";
foreach (file($projects_list_file) as $proj) {
	$proj = trim($proj);
	$conf['projects'][$proj] = array('repo'  => "$repo_home/$proj");
}
*/

// A bit sorter datetime format: YY-MM-DD HH:MM
$conf['datetime'] = '%y-%m-%d %H:%M';

// Extra security
$conf['allow_checkout'] = false;

// Exclude robots
//$conf['robots'] = "noindex, nofollow";
