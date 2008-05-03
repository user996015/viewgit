<h1>List of projects</h1>

<ul>
<?php
foreach ($page['projects'] as $p) {
	echo "<li><a href=\"?do=summary&amp;p=$p[name]\">$p[name]</a> - $p[description]</li>\n";
}
?>
</ul>

