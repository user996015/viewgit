<?php
echo
    '<div class="commitmessage">' .
        '<pre>' .
            //htmlentities_wrapper($page['message_full']) .
            htmlentities_wrapper($page['message_firstline']) .
        '</pre>' .
        '<div class="authorinfo">' .
            format_author($page['author_name']) .
            ' ' .
            '<span class="age">' .
                'authored ' .
                datetimeFormatDuration(time() - strtotime(htmlentities_wrapper($page['author_datetime']))) .
                ' ago' .
            '</span>' .
        '</div>' .
    '</div>' .
    '';
?>

<div class="filelist">
    <table>
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
