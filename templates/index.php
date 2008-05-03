<h1>List of projects</h1>

<ul>
<?php
foreach ($page['projects'] as $p) {
	echo "<li><a href=\"". makelink(array('a' => 'summary', 'p' => $p['name'])) . "\">$p[name]</a> - $p[description]</li>\n";
}
?>
</ul>

