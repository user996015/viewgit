<div class="tags">
    <h1>
        <a href="<?php echo makelink(array('a' => 'tags', 'p' => $page['project'])); ?>">Tags</a>
    </h1>

    <table>
        <thead>
            <tr>
                <th class="date">Date</th>
                <th class="branch">Tag</th>
                <th class="actions">Actions</th>
            </tr>
        </thead>
        <tbody>
<?php
$tr_class = 'even';

foreach ($page['tags'] as $tag) {
    $tr_class = $tr_class=='odd' ? 'even' : 'odd';
    echo
        '<tr class="' .$tr_class . '">' .
            '<td>' .
                $tag[date] .
            '</td>' .
            '<td>' .
                '<a href="' . makelink(array('a' => 'commits', 'p' => $page['project'], 'h' => $tag['fullname'])) . '">' .
                    $tag[name] .
                '</a>' .
            '</td>' .
            '<td></td>' .
        '</tr>' .
        '';
}
?>
        </tbody>
    </table>
</div>
