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

function makelink($dict)
{
	$params = array();
	foreach ($dict as $k => $v) {
		$params[] = rawurlencode($k) .'='. str_replace('%2F', '/', rawurlencode($v));
	}
	if (count($params) > 0) {
		return '?'. htmlentities(join('&', $params));
	}
	return '';
}

$action = 'index';
$template = '';
$page['title'] = 'ViewGit';

if (isset($_REQUEST['a'])) {
	$action = strtolower($_REQUEST['a']);
}

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
elseif ($action === 'summary') {
	$template = 'summary';
	$page['project'] = strtolower($_REQUEST['p']);

	$page['shortlog'] = array(
		array('author' => 'Author Name', 'date' => '2008-05-03 10:06:22', 'message' => 'Insightful commentary', 'commit_id' => '57c8cae91dd942a2e1d72cc995468abef2c2beeb'),
	);

	$page['heads'] = array(
		array('date' => '2008-05-03 10:11:23', 'name' => 'master'),
	);
}
else {
	die('Invalid action');
}

require 'templates/header.php';
require "templates/$template.php";
require 'templates/footer.php';
