<table>
    <thead>
        <tr>
            <th class="project">Project</th>
            <th class="description">Description</th>
            <th class="age">Age</th>
            <th class="message">Last Commit</th>
            <th class="actions">Actions</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach ($page['projects'] as $p) {
    $tr_class = $tr_class=='odd' ? 'even' : 'odd';

    echo
        '<tr class="' . $tr_class . '">' .
            '<td class="project">' .
                '<a href="' . makelink(array('a' => 'summary', 'p' => $p['name'])) . '">' .
                    $p['name'] .
                '</a>' .
                '';

    if ($p['www']) {
        //echo "<a href=\"$p[www]\" class=\"external\">&#8599;</a>";
        tpl_extlink($p['www']);
    }

    echo
            '</td>' .
            '<td class="description">' . htmlentities_wrapper($p['description']) . '</td>' .
            '<td class="age">' . ago($p['head_datetime']) . '</td>' .

            '<td class="message">' .
                htmlentities_wrapper($p['message']) . ' ' . format_author($p['committer_name'], $p['name']) .
            '</td>' .

            '<td class="actions">' .
                '<a href="' . makelink(array('a' => 'tree', 'p' => $p['name'], 'h' => $p['head_tree'], 'hb' => $p['head_hash'])) . '" class="tree" title="Tree">' .
                    '<img alt="tree" src="img/silk/chart_organisation.png" />' .
                '</a>' .

                '<a href="' . makelink(array('a' => 'archive', 'p' => $p['name'], 'h' => $p['head_tree'], 'hb' => $p['head_hash'], 't' => 'targz')) . '" rel="nofollow" class="tar" title="tar/gz">' .
                    '<img alt="tar/gz" src="img/silk/page_white_compressed.png" />' .
                '</a>' .

                '<a href="' . makelink(array('a' => 'archive', 'p' => $p['name'], 'h' => $p['head_tree'], 'hb' => $p['head_hash'], 't' => 'zip')) . '" rel="nofollow" class="zip" title="zip">' .
                    '<img alt="zip" src="img/silk/page_white_zip.png" />' .
                '</a>' .
            '</td>' .
        '</tr>' .
        '';
}
?>
    </tbody>
</table>
