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
foreach ($page['entries'] as $e) {
	if ($e['type'] === 'blob') {
		echo "<tr>\n";
		echo "\t<td>$e[mode]</td>\n";
		echo "\t<td><a href=\"". makelink(array('a' => 'viewblob', 'p' => $page['project'], 'h' => $e['hash'])) ."\">". htmlspecialchars($e['name']) ."</a></td>\n";
		echo "\t<td><a href=\"". makelink(array('a' => 'blob', 'p' => $page['project'], 'h' => $e['hash'], 'n' => $e['name'])) ."\">blob</a></td>\n";
	}
	else {
		echo "<tr class=\"dir\">\n";
		echo "\t<td>$e[mode]</td>\n";
		echo "\t<td><a href=\"" .makelink(array('a' => 'tree', 'p' => $page['project'], 'h' => $e['hash'], 'hb' => $page['commit_id'])) ."\">". htmlspecialchars($e['name']) ."/</a></td>\n";
		echo "\t<td><a href=\"". makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $e['hash'], 't' => 'targz', 'n' => $e['name'])) ."\">tar.gz</a> / <a href=\"". makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $e['hash'], 't' => 'zip', 'n' => $e['name'])) ."\">zip</a></td>\n";
	}
	echo "</tr>\n";
}
?>
</tbody>
</table>

<p>Download as <a href="<?php echo makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $page['tree_id'], 't' => 'targz')) ?>">tar.gz</a> or <a href="<?php echo makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $page['tree_id'], 't' => 'zip')) ?>">zip</a>.</p>

