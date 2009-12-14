<h1>Tags</h1>

<table class="heads">
<thead>
<tr>
	<th class="date">Date</th>
	<th class="branch">Tag</th>
	<th class="actions">Actions</th>
</tr>
</thead>
<tbody>
<?php
$tr_class = 'even';
foreach ($page['tags'] as $tag) {
	$tr_class = $tr_class=="odd" ? "even" : "odd";
	echo "<tr class=\"$tr_class\">\n";
	echo "\t<td>$tag[date]</td>\n";
	echo "\t<td><a href=\"". makelink(array('a' => 'shortlog', 'p' => $page['project'], 'h' => $tag['fullname'])) ."\">$tag[name]</a></td>\n";
	echo "\t<td></td>\n";
	echo "</tr>\n";
}
?>
</tbody>
</table>

