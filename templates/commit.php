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
