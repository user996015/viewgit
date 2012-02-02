<table class="tree">
<thead>
<tr>
	<th class="perm">Permissions</th>
	<th class="name">Name</th>
	<th class="dl">Download</th>
</tr>
</thead>
<tbody>
<?php
$entries = $page['entries'];
$folders = array();
$files = array();

foreach ($entries as $e) {
    if ($e['type'] === 'tree') {
        $folders[] = $e;
    }
    else {
        $files[] = $e;
    }
}

$sorted_entries = array_merge($folders, $files);

foreach ($sorted_entries as $e) {
	$tr_class = $tr_class=="odd" ? "even" : "odd";

	if (strlen($page['path']) > 0) {
		$path = $page['path'] .'/'. $e['name'];
	}
	else {
		$path = $e['name'];
	}
	if ($e['type'] === 'blob') {
		echo "<tr class=\"blob $tr_class\">\n";
		echo "\t" . '<td class="perm">' . $e[mode] . '</td>' . "\n";
		echo "\t" . '<td class="name">' . "<a href=\"". makelink(array('a' => 'viewblob', 'p' => $page['project'], 'h' => $e['hash'], 'hb' => $page['commit_id'], 'f' => $path)) ."\" class=\"item_name\">". htmlspecialchars($e['name']) ."</a></td>\n";
		echo "\t" . '<td class="dl">' . "<a href=\"". makelink(array('a' => 'blob', 'p' => $page['project'], 'h' => $e['hash'], 'n' => $e['name'])) ."\">blob</a></td>\n";
	}
	else {
		echo "<tr class=\"dir $tr_class\">\n";
		echo "\t" . '<td class="perm">' . $e[mode] . '</td>' . "\n";
		echo "\t" . '<td class="name">' . "<a href=\"" .makelink(array('a' => 'tree', 'p' => $page['project'], 'h' => $e['hash'], 'hb' => $page['commit_id'], 'f' => $path)) ."\" class=\"item_name\">". htmlspecialchars($e['name']) ."/</a></td>\n";
		echo "\t" . '<td class="dl">' . "<a href=\"". makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $e['hash'], 'hb' => $page['commit_id'], 't' => 'targz', 'n' => $e['name'])) ."\" class=\"tar_link\" title=\"tar/gz\">tar.gz</a> <a href=\"". makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $e['hash'], 'hb' => $page['commit_id'], 't' => 'zip', 'n' => $e['name'])) ."\" class=\"zip_link\" title=\"zip\">zip</a></td>\n";
	}
	echo "</tr>\n";
}
?>
</tbody>
</table>

<p>Download as <a href="<?php echo makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $page['tree_id'], 'hb' => $page['commit_id'], 't' => 'targz')) ?>" rel="nofollow">tar.gz</a> or <a href="<?php echo makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $page['tree_id'], 'hb' => $page['commit_id'], 't' => 'zip')) ?>" rel="nofollow">zip</a>. Browse this tree at the <a href="<?php echo makelink(array('a' => 'tree', 'p' => $page['project'], 'hb' => 'HEAD', 'f' => $page['path'])); ?>">HEAD</a>.</p>

