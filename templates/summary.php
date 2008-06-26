<?php
require_once('templates/shortlog.php');
?>

<?php
require_once('templates/tags.php');
?>

<p><a href="<?php echo makelink(array('a' => 'tags', 'p' => $page['project'])) ?>">View all tags</a></p>

<h1>Heads</h1>

<table class="heads">
<thead>
<tr>
	<th class="date">Date</th>
	<th class="branch">Branch</th>
	<th class="actions">Actions</th>
</tr>
</thead>
<tbody>
<?php
foreach ($page['heads'] as $h) {
	echo "<tr>\n";
	echo "\t<td>$h[date]</td>\n";
	echo "\t<td><a href=\"". makelink(array('a' => 'shortlog', 'p' => $page['project'], 'h' => $h['fullname'])) ."\">$h[name]</a></td>\n";
	echo "\t<td></td>\n";
	echo "</tr>\n";
}
?>
</tbody>
</table>

