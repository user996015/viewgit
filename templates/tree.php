<pre>
<?php
foreach ($page['entries'] as $e) {
	echo "$e[mode] ";
	if ($e['type'] === 'blob') {
		echo "<a href=\"". makelink(array('a' => 'blob', 'p' => $page['project'], 'h' => $e['hash'])) ."\">$e[name]</a>";
		// download blob
		echo " [<a href=\"". makelink(array('a' => 'blob', 'p' => $page['project'], 'h' => $e['hash'], 'n' => $e['name'])) ."\">download</a>]";
	}
	else {
		echo "<a href=\"". makelink(array('a' => 'tree', 'p' => $page['project'], 'h' => $e['hash'])) ."\">$e[name]/</a>";
		// download tar/zip
		echo " [download <a href=\"". makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $e['hash'], 't' => 'targz')) ."\">tar.gz</a> / <a href=\"". makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $e['hash'], 't' => 'zip')) ."\">zip</a>]";
	}
	
	echo "\n";
}
?>
</pre>

<p>Download as <a href="<?php echo makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $page['tree'], 't' => 'targz')) ?>">tar.gz</a> or <a href="<?php echo makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $page['tree'], 't' => 'zip')) ?>">zip</a>.</p>

