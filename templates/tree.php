<h1>Tree <?php echo $page['tree']; ?> for project <?php echo $page['project']; ?></h1>

<pre>
<?php
foreach ($page['entries'] as $e) {
	echo "$e[mode] ";
	if ($e['type'] === 'blob') {
		echo "<a href=\"". makelink(array('a' => 'blob', 'p' => $page['project'], 'h' => $e['hash'])) ."\">$e[name]</a>";
	}
	else {
		echo "<a href=\"". makelink(array('a' => 'tree', 'p' => $page['project'], 'h' => $e['hash'])) ."\">$e[name]/</a>";
	}
	
	echo "\n";
}
?>
</pre>

