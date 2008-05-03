<h1>Summary for <?php echo $page['project']; ?></h1>

<h2>Shortlog</h2>
<ul>
<?php
foreach ($page['shortlog'] as $l) {
	echo "<li>$l[date] - $l[author] - <a href=\"". makelink(array('a' => 'commit', 'p' => $page['project'], 'h' => $l['commit_id'])) ."\">$l[message]</a></li>";
}
?>
</ul>

<h2>Heads</h2>
<ul>
<?php
foreach ($page['heads'] as $h) {
	echo "<li>$h[date] - <a href=\"". makelink(array('a' => 'shortlog', 'p' => $page['project'], 'h' => "$h[fullname]")) ."\">$h[name]</a></li>";
}
?>
</ul>


