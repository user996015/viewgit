<?php
error_reporting(E_ALL);

require_once('inc/config.php');

function get_project_info($name)
{
	global $conf;

	$info = $conf['projects'][$name];
	$info['name'] = $name;
	$info['description'] = file_get_contents($info['repo'] .'/description');

	return $info;
}

$action = 'index';
$template = '';
$page['title'] = 'ViewGit';

if ($action === 'index') {
	$template = 'index';

	foreach (array_keys($conf['projects']) as $p) {
		$page['projects'][] = get_project_info($p);
	}

	/*
	$page['projects'] = array(
		array('name' => 'projecta', 'description' => 'project a description'),
		array('name' => 'projectb', 'description' => 'project b description'),
	);
	*/
}
else {
	die('Invalid action');
}

require 'templates/header.php';
require "templates/$template.php";
require 'templates/footer.php';
