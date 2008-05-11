<h1>List of projects</h1>

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
	echo "\t<td>$p[description]</td>\n";
	echo "\t<td>$p[head_datetime]</td>\n";
	echo "\t<td>";
	echo "[<a href=\"". makelink(array('a' => 'tree', 'p' => $p['name'], 'h' => $p['head_tree'])) ."\">tree</a>]";
	echo "[<a href=\"". makelink(array('a' => 'archive', 'p' => $p['name'], 'h' => $p['head_tree'], 't' => 'targz')) ."\">tar/gz]";
	echo "[<a href=\"". makelink(array('a' => 'archive', 'p' => $p['name'], 'h' => $p['head_tree'], 't' => 'zip')) ."\">zip]";
	echo "</td>\n";
	echo "</tr>\n";
}
?>
</tbody>
</table>

