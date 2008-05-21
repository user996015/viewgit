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
elseif ($page['action'] === 'tree') {
	echo " : Tree $page[tree]";
}
elseif ($page['action'] === 'viewblob') {
	echo " : Blob $page[hash]";
}
?>
</div>
