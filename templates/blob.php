<?php
echo
    '<div class="commitmessage">' .
        '<pre>' .
            //htmlentities_wrapper($page['lastlog']['message_full']) .
            htmlentities_wrapper($page['lastlog']['message_firstline']) .
        '</pre>' .

        '<div class="authorinfo">' .
            format_author($page['lastlog']['author_name']) .
            ' ' .
            '<span class="age">' .
                'authored ' .
                ago(htmlentities_wrapper($page['lastlog']['author_datetime'])) .
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
    $file = htmlentities_wrapper($page['path']);
    $url = makelink(array('a' => 'commit', 'p' => $page['project'], 'h' => $page['lastlog']['h']));
    $hash = htmlentities_wrapper($page['lastlog']['h']);
    echo
        '<tr>' .
            '<td>' .
                '<a href="' . $url . '">' . $file . '</a>' .
            '</td>' .
            '<td>' .
                '<a href="' . $url . '">' . $hash . '</a>' .
            '</td>' .
        '</tr>' .
        '';
?>
        </tbody>
    </table>
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
