<h1>
    <span><?php echo htmlentities_wrapper($page['message_firstline']); ?></span>
</h1>

<div class="authorinfo">
<?php
echo format_author($page['author_name']);
echo ' ['. $page['author_datetime'] .']';
?>
</div>

<div class="commitmessage">
    <pre><?php echo htmlentities_wrapper($page['message_full']); ?></pre>
</div>

<div class="filelist">
    <table>
        <thead>
            <tr>
                <th>Filename</th>
            </tr>
        </thead>
        <tbody>
<?php
// pathname | patch | blob | history
foreach ($page['files'] as $file => $url) {
    echo
        '<tr>' .
            '<td>' .
                '<a href="#' . $url . '">' . $file . '</a>' .
            '</td>' .
        '</tr>' .
        '';
}
?>
</tbody>
</table>
</div>

<div class="diff">
<pre>
<?php echo $page['diffdata']; ?>
</pre>
</div>
