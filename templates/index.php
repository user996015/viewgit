<h1>List of projects</h1>

<table>
<thead>
<tr>
	<th>Project</th>
	<th>Description</th>
	<!-- <th>Last Change</th> -->
	<th></th>
</tr>
</thead>
<tbody>
<?php
foreach ($page['projects'] as $p) {
	echo "<tr>\n";
	echo "\t<td><a href=\"". makelink(array('a' => 'summary', 'p' => $p['name'])) ."\">$p[name]</a></td>\n";
	echo "\t<td>$p[description]</td>\n";
	echo "\t<td></td>\n";
	echo "</tr>\n";
}
?>
</tbody>
</table>

