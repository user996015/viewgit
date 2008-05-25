
<table>
<thead>
<tr>
	<th>Project</th>
	<th>Description</th>
	<th>Last Change</th>
	<th>Actions</th>
</tr>
</thead>
<tbody>
<?php
foreach ($page['projects'] as $p) {
	echo "<tr>\n";
	echo "\t<td><a href=\"". makelink(array('a' => 'summary', 'p' => $p['name'])) ."\">$p[name]</a></td>\n";
	echo "\t<td>". htmlentities($p['description']) ."</td>\n";
	echo "\t<td>". htmlentities($p['head_datetime']) ."</td>\n";
	echo "\t<td>";
	echo "[<a href=\"". makelink(array('a' => 'tree', 'p' => $p['name'], 'h' => $p['head_tree'], 'hb' => $p['head_hash'])) ."\">tree</a>]";
	echo "[<a href=\"". makelink(array('a' => 'archive', 'p' => $p['name'], 'h' => $p['head_tree'], 't' => 'targz')) ."\">tar/gz</a>]";
	echo "[<a href=\"". makelink(array('a' => 'archive', 'p' => $p['name'], 'h' => $p['head_tree'], 't' => 'zip')) ."\">zip</a>]";
	echo "</td>\n";
	echo "</tr>\n";
}
?>
</tbody>
</table>

