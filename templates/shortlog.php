<h1>Shortlog</h1>

<table class="shortlog">
<thead>
<tr>
	<th class="date">Date</th>
	<th class="author">Author</th>
	<th class="message">Message</th>
	<th class="actions">Actions</th>
</tr>
</thead>
<tbody>
<?php
$page['lasthash'] = 'HEAD';
foreach ($page['shortlog'] as $l) {
	echo "<tr>\n";
	echo "\t<td>$l[date]</td>\n";
	echo "\t<td>$l[author]</td>\n";
	echo "\t<td><a href=\"". makelink(array('a' => 'commit', 'p' => $page['project'], 'h' => $l['commit_id'])) ."\">$l[message]</a></td>\n";
	echo "\t<td>";
	echo "[<a href=\"". makelink(array('a' => 'commitdiff', 'p' => $page['project'], 'h' => $l['commit_id'])) ."\">commitdiff</a>]";
	echo "[<a href=\"". makelink(array('a' => 'tree', 'p' => $page['project'], 'h' => $l['tree'])) ."\">tree</a>]";
	echo "[<a href=\"". makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $l['tree'], 't' => 'targz')) ."\">tar/gz</a>]";
	echo "[<a href=\"". makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $l['tree'], 't' => 'zip')) ."\">zip</a>]";
	echo "</td>\n";
	echo "</tr>\n";
	$page['lasthash'] = $l['commit_id'];
}
?>
</tbody>
</table>

<?php 
if ($page['lasthash'] !== 'HEAD') {
	echo "<p><a href=\"". makelink(array('a' => 'shortlog', 'p' => $page['project'], 'h' => $page['lasthash'])) ."\">More...</a></p>";
}
?>
