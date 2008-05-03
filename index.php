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

/**
 * Get details of a commit: tree, parent, author/committer (name, mail, date), message
 */
function git_get_commit_info($project, $hash)
{
	$info = array();
	$info['h'] = $hash;

	$output = run_git($project, "git-rev-list --header --max-count=1 $hash");
	// tree <h>
	// parent <h>
	// author <name> "<"<mail>">" <stamp> <timezone>
	// committer
	// <empty>
	//     <message>
	$pattern = '/^(author|committer) ([^<]+) <([^>]*)> ([0-9]+) (.*)$/';
	foreach ($output as $line) {
		if (substr($line, 0, 4) === 'tree') {
			$info['tree'] = substr($line, 5);
		}
		elseif (substr($line, 0, 6) === 'parent') {
			$info['parent']  = substr($line, 7);
		}
		elseif (preg_match($pattern, $line, $matches) > 0) {
			$info[$matches[1] .'_name'] = $matches[2];
			$info[$matches[1] .'_mail'] = $matches[3];
			$info[$matches[1] .'_stamp'] = $matches[4];
			$info[$matches[1] .'_timezone'] = $matches[5];
		}
		elseif (substr($line, 0, 4) == '    ') {
			$info['message'] = substr($line, 4, 40);
		}
	}

	return $info;
}

function git_get_heads($project)
{
	$heads = array();

	$output = run_git($project, 'git-show-ref --heads');
	foreach ($output as $line) {
		$fullname = substr($line, 41);
		$name = array_pop(explode('/', $fullname));
		$heads[] = array('h' => substr($line, 0, 40), 'fullname' => "$fullname", 'name' => "$name");
	}

	return $heads;
}

function git_get_rev_list($project)
{
	return run_git($project, 'git-rev-list HEAD');
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

/**
 * Executes a git command in the project repo.
 * @return array of output lines
 */
function run_git($project, $command)
{
	global $conf;

	$output = array();
	$cmd = "GIT_DIR=". $conf['projects'][$project]['repo'] ." $command";
	exec($cmd, &$output);
	return $output;
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
}
elseif ($action === 'summary') {
	$template = 'summary';
	$page['project'] = strtolower($_REQUEST['p']);
	// TODO: validate project
	
	$revs = git_get_rev_list($page['project']);
	foreach ($revs as $rev) {
		$info = git_get_commit_info($page['project'], $rev);
		$page['shortlog'][] = array(
			'author' => $info['author_name'],
			'date' => strftime($conf['datetime'], $info['author_stamp']),
			'message' => $info['message'],
			'commit_id' => $rev,
		);
	}

	$heads = git_get_heads($page['project']);
	$page['heads'] = array();
	foreach ($heads as $h) {
		$info = git_get_commit_info($page['project'], $h['h']);
		$page['heads'][] = array(
			'date' => strftime($conf['datetime'], $info['author_stamp']),
			'h' => $h['h'],
			'fullname' => $h['fullname'],
			'name' => $h['name'],
		);
	}
}
else {
	die('Invalid action');
}

require 'templates/header.php';
require "templates/$template.php";
require 'templates/footer.php';
