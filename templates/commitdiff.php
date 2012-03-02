<?php
require_once('templates/commitmessage.php');
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
