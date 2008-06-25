<?php
/** @file
 * Functions used by ViewGit.
 */

function debug($msg)
{
	file_put_contents('/tmp/viewgit.log', strftime('%H:%M:%S') ." $_SERVER[REMOTE_ADDR]:$_SERVER[REMOTE_PORT] $msg\n", FILE_APPEND);
}

/**
 * Formats "git diff" output into xhtml.
 * @return array(array of filenames, xhtml)
 */
function format_diff($text)
{
	$files = array();

	// match every "^diff --git a/<path> b/<path>$" line
	foreach (explode("\n", $text) as $line) {
		if (preg_match('#^diff --git a/(.*) b/(.*)$#', $line, $matches) > 0) {
			$files[$matches[1]] = urlencode($matches[1]);
		}
	}

	$text = htmlentities($text);

	$text = preg_replace(
		array(
			'/^(\+.*)$/m',
			'/^(-.*)$/m',
			'/^(@.*)$/m',
			'/^([^d\+-@].*)$/m',
		),
		array(
			'<span class="add">$1</span>',
			'<span class="del">$1</span>',
			'<span class="pos">$1</span>',
			'<span class="etc">$1</span>',
		),
		$text);
	$text = preg_replace_callback('#^diff --git a/(.*) b/(.*)$#m',
		create_function(
			'$m',
			'return "<span class=\"diffline\"><a name=\"". urlencode($m[1]) ."\">diff --git a/$m[1] b/$m[2]</a></span>";'
		),
		$text);

	return array($files, $text);
}

/**
 * Get project information from config and git, name/description and HEAD
 * commit info are returned in an array.
 */
function get_project_info($name)
{
	global $conf;

	$info = $conf['projects'][$name];
	$info['name'] = $name;
	$info['description'] = file_get_contents($info['repo'] .'/description');

	$headinfo = git_get_commit_info($name, 'HEAD');
	$info['head_stamp'] = $headinfo['author_utcstamp'];
	$info['head_datetime'] = strftime($conf['datetime'], $headinfo['author_utcstamp']);
	$info['head_hash'] = $headinfo['h'];
	$info['head_tree'] = $headinfo['tree'];

	return $info;
}

/**
 * Get details of a commit: tree, parents, author/committer (name, mail, date), message
 */
function git_get_commit_info($project, $hash = 'HEAD')
{
	global $conf;

	$info = array();
	$info['h_name'] = $hash;
	$info['message_full'] = '';
	$info['parents'] = array();

	$output = run_git($project, "git rev-list --header --max-count=1 $hash");
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
		// may be repeated multiple times for merge/octopus
		elseif (substr($line, 0, 6) === 'parent') {
			$info['parents'][] = substr($line, 7);
		}
		elseif (preg_match($pattern, $line, $matches) > 0) {
			$info[$matches[1] .'_name'] = $matches[2];
			$info[$matches[1] .'_mail'] = $matches[3];
			$info[$matches[1] .'_stamp'] = $matches[4];
			$info[$matches[1] .'_timezone'] = $matches[5];
			$info[$matches[1] .'_utcstamp'] = $matches[4] - ((intval($matches[5]) / 100.0) * 3600);
		}
		elseif (substr($line, 0, 4) === '    ') {
			$info['message_full'] .= substr($line, 4) ."\n";
			if (!isset($info['message'])) {
				$info['message'] = substr($line, 4, $conf['commit_message_maxlen']);
				$info['message_firstline'] = substr($line, 4);
			}
		}
		elseif (preg_match('/^[0-9a-f]{40}$/', $line) > 0) {
			$info['h'] = $line;
		}
	}

	return $info;
}

/**
 * Get list of heads (branches) for a project.
 */
function git_get_heads($project)
{
	$heads = array();

	$output = run_git($project, 'git show-ref --heads');
	foreach ($output as $line) {
		$fullname = substr($line, 41);
		$name = array_pop(explode('/', $fullname));
		$heads[] = array('h' => substr($line, 0, 40), 'fullname' => "$fullname", 'name' => "$name");
	}

	return $heads;
}

/**
 * Get array containing path information for parts, starting from root_hash.
 *
 * @param root_hash commit/tree hash for the root tree
 * @param parts array of path fragments
 */
function git_get_path_info($project, $root_hash, $parts)
{
	$pathinfo = array();

	$tid = $root_hash;
	$pathinfo = array();
	foreach ($parts as $p) {
		$entry = git_ls_tree_part($project, $tid, $p);
		$pathinfo[] = $entry;
		$tid = $entry['hash'];
	}

	return $pathinfo;
}

/**
 * Get revision list starting from given commit.
 * @param max_count number of commit hashes to return, or all if not given
 * @param start revision to start from, or HEAD if not given
 */
function git_get_rev_list($project, $max_count = null, $start = 'HEAD')
{
	$cmd = "git rev-list $start";
	if (!is_null($max_count)) {
		$cmd = "git rev-list --max-count=$max_count $start";
	}

	return run_git($project, $cmd);
}

/**
 * Get list of tags for a project.
 */
function git_get_tags($project)
{
	$tags = array();

	$output = run_git($project, 'git show-ref --tags');
	foreach ($output as $line) {
		$fullname = substr($line, 41);
		$name = array_pop(explode('/', $fullname));
		$tags[] = array('h' => substr($line, 0, 40), 'fullname' => $fullname, 'name' => $name);
	}
	return $tags;
}

/**
 * Get information about objects in a tree.
 * @param tree tree or commit hash
 * @return list of arrays containing name, mode, type, hash
 */
function git_ls_tree($project, $tree)
{
	$entries = array();
	$output = run_git($project, "git ls-tree $tree");
	// 100644 blob 493b7fc4296d64af45dac64bceac2d9a96c958c1    .gitignore
	// 040000 tree 715c78b1011dc58106da2a1af2fe0aa4c829542f    doc
	foreach ($output as $line) {
		$parts = preg_split('/\s+/', $line, 4);
		$entries[] = array('name' => $parts[3], 'mode' => $parts[0], 'type' => $parts[1], 'hash' => $parts[2]);
	}

	return $entries;
}

/**
 * Get information about the given object in a tree, or null if not in the tree.
 */
function git_ls_tree_part($project, $tree, $name)
{
	$entries = git_ls_tree($project, $tree);
	foreach ($entries as $entry) {
		if ($entry['name'] === $name) {
			return $entry;
		}
	}
	return null;
}

/**
 * Return a URL that contains the given parameters.
 */
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

function rss_pubdate($secs)
{
	return date('D, d M Y H:i:s O', $secs);
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

/**
 * Executes a git command in the project repo, sending output directly to the
 * client.
 */
function run_git_passthru($project, $command)
{
	global $conf;

	$cmd = "GIT_DIR=". $conf['projects'][$project]['repo'] ." $command";
	$result = 0;
	passthru($cmd, &$result);
	return $result;
}

/**
 * Makes sure the given project is valid. If it's not, this function will
 * die().
 * @return the project
 */
function validate_project($project)
{
	global $conf;

	if (!in_array($project, array_keys($conf['projects']))) {
		die('Invalid project');
	}
	return $project;
}

/**
 * Makes sure the given hash is valid. If it's not, this function will die().
 * @return the hash
 */
function validate_hash($hash)
{
	if (!preg_match('/^[0-9a-z]{40}$/', $hash) && !preg_match('!^refs/(heads|tags)/[-.0-9a-z]+$!', $hash)) {
		die('Invalid hash');

	}
	return $hash;
}

