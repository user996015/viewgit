<?php
require_once('templates/shortlog.php');
require_once('templates/tags.php');
?>

<div class="summary">
    <h1>
        <span>Heads</span>
    </h1>

    <table class="heads">
        <thead>
            <tr>
                <th class="date">Date</th>
                <th class="branch">Branch</th>
                <th class="actions">Actions</th>
            </tr>
        </thead>
    <tbody>
<?php
$tr_class = 'even';

foreach ($page['heads'] as $h) {
    $tr_class = $tr_class=='odd' ? 'even' : 'odd';

    echo
        '<tr class="' . $tr_class . '">' .
            '<td>' . $h[date] . '</td>' .
            '<td>' .
                '<a href="' . makelink(array('a' => 'shortlog', 'p' => $page['project'], 'h' => $h['fullname'])) . '">' .
                    $h['name'] .
                '</a>' .
            '</td>' .
            '<td></td>' .
        '</tr>' .
        '';
}
?>
        </tbody>
    </table>

<?php
// call plugins that register "summary" hook
if (in_array('summary', array_keys(VGPlugin::$plugin_hooks))) {
    VGPlugin::call_hooks('summary');
}
?>

</div>
