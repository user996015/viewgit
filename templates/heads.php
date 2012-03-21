<div class="heads">
    <h1>
        <span>Heads</span>
    </h1>

    <table>
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
    $tr_class = $tr_class == 'odd' ? 'even' : 'odd';

    echo
        '<tr class="' . $tr_class . '">' .
            '<td class="date">' .
                $h['age'] .
            '</td>' .
            '<td class="branch">' .
                '<a href="' . makelink(array('a' => 'commits', 'p' => $page['project'], 'h' => $h['fullname'])) . '">' .
                    $h['name'] .
                '</a>' .
            '</td>' .
            '<td class="actions">' .
                '&nbsp;' .
            '</td>' .
        '</tr>' .
        '';
}
?>
        </tbody>
    </table>
</div>
