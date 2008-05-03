<h1>Commit <?php echo $page['commit_id']; ?> for project <?php echo $page['project']; ?></h1>

<h2><?php echo $page['message']; ?></h2>

<ul>
	<li>Author: <?php echo $page['author_name']; ?> &lt;<?php echo $page['author_mail']; ?>&gt;</li>
	<li>Author date:</li>
	<li>Committer: <?php echo $page['committer_name']; ?> &lt;<?php echo $page['committer_mail']; ?>&gt;</li>
	<li>Committer date:</li>
	<li>Commit: <?php echo $page['commit_id']; ?></li>
	<li>Tree: <?php echo $page['tree']; ?></li>
	<li>Parent: <?php echo $page['parent']; ?></li>
</ul>

<div class="message"><?php echo $page['message_full']; ?></div>

<?php /* TODO: list of files changed */ ?>

