<h1><?php echo $page['message']; ?></h1>

<table class="commit">
<tbody>
<tr>
	<td>Author</td>
	<td><?php echo $page['author_name']; ?> &lt;<?php echo $page['author_mail']; ?>&gt;</td>
</tr>
<tr>
	<td>Author date</td>
	<td><?php echo $page['author_datetime']; ?></td>
</tr>
<tr>
	<td>Author local date</td>
	<td><?php echo $page['author_datetime_local']; ?></td>
</tr>
<tr>
	<td>Committer</td>
	<td><?php echo $page['committer_name']; ?> &lt;<?php echo $page['committer_mail']; ?>&gt;</td>
</tr>
<tr>
	<td>Committer date</td>
	<td><?php echo $page['committer_datetime']; ?></td>
</tr>
<tr>
	<td>Committer local date</td>
	<td><?php echo $page['committer_datetime_local']; ?></td>
</tr>
<tr>
	<td>Commit</td>
	<td><?php echo $page['commit_id']; ?></td>
</tr>
<tr>
	<td>Tree</td>
	<td><a href="<?php echo makelink(array('a' => 'tree', 'p' => $page['project'], 'h' => $page['tree'])); ?>"><?php echo $page['tree']; ?></a></td>
</tr>
<tr>
	<td>Parent</td>
	<td><a href="<?php echo makelink(array('a' => 'commit', 'p' => $page['project'], 'h' => $page['parent'])); ?>"><?php echo $page['parent']; ?></a></td>
</tr>
</tbody>
</table>

<div class="message"><?php echo $page['message_full']; ?></div>

<?php /* TODO: list of files changed */ ?>

