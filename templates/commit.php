<h1>Commit <?php echo $page['commit_id']; ?> for project <?php echo $page['project']; ?></h1>

<h2><?php echo $page['message']; ?></h2>

<ul>
	<li>Author: <?php echo $page['author_name']; ?> &lt;<?php echo $page['author_mail']; ?>&gt;</li>
	<li>Author date: <?php echo $page['author_datetime']; ?></li>
	<li>Committer: <?php echo $page['committer_name']; ?> &lt;<?php echo $page['committer_mail']; ?>&gt;</li>
	<li>Committer date: <?php echo $page['committer_datetime']; ?></li>
	<li>Commit: <?php echo $page['commit_id']; ?></li>
	<li>Tree: <a href="<?php echo makelink(array('a' => 'tree', 'p' => $page['project'], 'h' => $page['tree'])); ?>"><?php echo $page['tree']; ?></a></li>
	<li>Parent: <a href="<?php echo makelink(array('a' => 'commit', 'p' => $page['project'], 'h' => $page['parent'])); ?>"><?php echo $page['parent']; ?></a></li>
</ul>

<div class="message"><?php echo $page['message_full']; ?></div>

<?php /* TODO: list of files changed */ ?>

