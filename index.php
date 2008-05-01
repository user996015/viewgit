<?php
error_reporting(E_ALL);

require_once('inc/config.php');

$action = 'index';
$template = '';
$page['title'] = 'ViewGit';

if ($action === 'index') {
	$template = 'index';

	$page['projects'] = array(
		array('name' => 'projecta', 'description' => 'project a description'),
		array('name' => 'projectb', 'description' => 'project b description'),
	);
}
else {
	die('Invalid action');
}

require 'templates/header.php';
require "templates/$template.php";
require 'templates/footer.php';
