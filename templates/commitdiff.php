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

<?php
echo
    '<div class="diff">' .
        '<pre>' .
            $page['diffdata'] .
        '</pre>' .
    '</div>' .
    '';
?>

<!-- start commit -->

<table>
    <tbody>
        <tr>
            <td>Author</td>
            <td><?php echo format_author($page['author_name']); ?> &lt;<?php echo htmlentities_wrapper($page['author_mail']); ?>&gt;</td>
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
            <td><?php echo format_author($page['committer_name']); ?> &lt;<?php echo htmlentities_wrapper($page['committer_mail']); ?>&gt;</td>
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
            <td><a href="<?php echo makelink(array('a' => 'tree', 'p' => $page['project'], 'h' => $page['tree_id'], 'hb' => $page['commit_id'])); ?>"><?php echo $page['tree_id']; ?></a></td>
        </tr>

<?php
foreach ($page['parents'] as $parent) {
    echo
        '<tr>' .
            '<td>Parent</td>' .
            '<td>' .
                '<a href="' . makelink(array('a' => 'commit', 'p' => $page['project'], 'h' => $parent)) . '">' .
                    $parent .
                '</a>' .
            '</td>' .
        '</tr>' .
        '';
}
?>
    </tbody>
</table>

<!-- end commit -->
