<?php
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title><?php echo $page['title']; ?></title>
	<link rel="stylesheet" href="default.css" type="text/css" />
</head>
<body>

<div class="nav">
<a href=".">Index</a>
<?php
if (isset($page['project'])) {
	echo " &raquo; <a href=\"". makelink(array('a' => 'summary', 'p' => $page['project'])) ."\">$page[project]</a>";
}
// TODO: move this out of here
if ($page['action'] === 'summary') {
	echo " : Summary";
}
elseif ($page['action'] === 'commit') {
	echo " : Commit $page[commit_id]";
}
elseif ($page['action'] === 'shortlog') {
	echo " : Shortlog";
}
elseif ($page['action'] === 'tree') {
	echo " : Tree $page[tree_id]";
}
elseif ($page['action'] === 'viewblob') {
	echo " : Blob $page[hash]";
}

if (isset($page['path'])) {
	echo ' / ';
	echo htmlentities(join(' / ', explode('/', $page['path'])));
}
?>
</div>

<?php if (isset($page['project'])) { ?>
<div class="pagenav">
<?php
$links = array(
	'summary' => array(),
	'shortlog' => array(),
	'commit' => array('h' => $page['commit_id']),
	'commitdiff' => array('h' => $page['commit_id']),
	'tree' => array('h' => $page['tree_id'], 'hb' => $page['commit_id']),
);
$first = true;
foreach ($links as $link => $params) {
	if (!$first) { echo " | "; }
	if ($page['action'] === $link) { echo '<span class="cur">'; }
	echo "<a href=\"". makelink(array_merge(array('a' => $link, 'p' => $page['project']), $params)) ."\">". ucfirst($link) . "</a>";
	if ($page['action'] === $link) { echo '</span>'; }
	$first = false;
}
?>
</div>
<? } ?>

