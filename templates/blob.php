<h2>Last commit for <?php echo $page['path']; ?>: <a href="<?php echo makelink(array('a' => 'commit', 'p' => $page['project'], 'h' => $page['lastlog']['h'])); ?>"><?php echo htmlentities_wrapper($page['lastlog']['h']); ?></a></h2>
<h1><?php echo htmlentities_wrapper($page['lastlog']['message_firstline']); ?></h1>
<div class="authorinfo">
<?php
echo format_author($page['lastlog']['author_name']);
echo ' ['. $page['lastlog']['author_datetime'] .']';
?>
</div>
<div class="commitmessage">
<pre>
<?php echo htmlentities_wrapper($page['lastlog']['message_full']); ?>
</pre>
</div>
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
