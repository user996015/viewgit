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
	echo join(' / ', explode('/', $page['path']));
}
?>
</div>

<?php if (isset($page['project'])) { ?>
<div class="pagenav">
<a href="<?php echo makelink(array('a' => 'summary', 'p' => $page['project'])); ?>">Summary</a> |
<a href="<?php echo makelink(array('a' => 'shortlog', 'p' => $page['project'])); ?>">Shortlog</a> |
<a href="<?php echo makelink(array('a' => 'commit', 'p' => $page['project'], 'h' => $page['commit_id'])); ?>">Commit</a> |
<a href="<?php echo makelink(array('a' => 'commitdiff', 'p' => $page['project'], 'h' => $page['commit_id'])); ?>">Commitdiff</a> |
<a href="<?php echo makelink(array('a' => 'tree', 'p' => $page['project'], 'h' => $page['tree_id'], 'hb' => $page['commit_id'])); ?>">Tree</a>
</div>
<? } ?>
