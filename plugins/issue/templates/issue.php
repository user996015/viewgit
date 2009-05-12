<?php
global $page;
?>

<h1><a href="<?php echo makelink(array('a' => 'issue', 'p' => $page['project']));?>">Issues</a> - <?php print $page['issue']['title'];?></h1>

<pre>
<?php
print_r($page);

?>
</pre>
