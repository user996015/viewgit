<?php

error_reporting(E_ALL);

$action = 'index';
$template = '';
$page['title'] = 'ViewGit';

if ($action === 'index') {
	$template = 'index';
}
else {
	die('Invalid action');
}

require 'templates/header.php';
require "templates/$template.php";
require 'templates/footer.php';
