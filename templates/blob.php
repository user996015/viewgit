<h1>Last commit</h1>
<?php
echo $page['lastlog'];
?>
<div class="file">
<?php
if (isset($page['html_data'])) {
	echo $page['html_data'];
}
else {
?>
<pre>
<?php echo htmlspecialchars($page['data']); ?>
</pre>
</div>
<?php
}
?>
