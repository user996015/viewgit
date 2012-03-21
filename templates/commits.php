<?php
echo
    '<div class="commits">' .
        /*
        '<h1>' .
            '<a href="' . makelink(array('a' => 'commits', 'p' => $page['project'])) . '">' .
                'Commit History' .
            '</a>' .
        '</h1>' .
        */

        '';

$page['lasthash'] = 'HEAD';

$last_friendly_date = '';
$first = true;

foreach ($page['shortlog'] as $l) {
    $alternate_class = $alternate_class == 'odd' ? 'even' : 'odd';

    if (!($last_friendly_date === $l['friendly_date'])) {
        if (!$first) {
            echo '</ol>';
        }

        $last_friendly_date = $l['friendly_date'];

        echo
            '<h3>' . $last_friendly_date . '</h3>' .

            '<ol>' .
            '';
    }

    $last_date = '';

    echo
        '<li class="' . $alternate_class . '">' .
            '<span class="message">' .
                '<a href="' . makelink(array('a' => 'commit', 'p' => $page['project'], 'h' => $l['commit_id'])) . '">' .
                    htmlentities_wrapper($l['message']) .
                '</a>' .
            '</span>' .

            '<span class="authorship">' .
                '<span class="author">' .
                    format_author($l['author']) .
                '</span>' .

                'authored ' .
                '<time datetime="' . date(DATE_W3C, $l['author_utcstamp']) . '">' .
                    $l['age'] .
                '</time>' .
                ' ago' .
            '</span>' .
            '';

    /*
    if (count($l['refs']) > 0) {
        foreach ($l['refs'] as $ref) {
            $parts = explode('/', $ref);
            $shortref = join('/', array_slice($parts, 1));
            $type = 'head';

            if ($parts[0] == 'tags') {
                $type = 'tag';
            }
            elseif ($parts[0] == 'remotes') {
                $type = 'remote';
            }

            echo '<span class="label ' . $type . '" title="' . $ref . '">' . $shortref . '</span>';
        }
    }
    */

    /*
        '<td class="actions">' .
            '<a href="' . makelink(array('a' => 'commitdiff', 'p' => $page['project'], 'h' => $l['commit_id'])) . '" class="diff" title="Commit Diff">' .
                '<img alt="diff" src="img/silk/commit_diff.png" />' .
            '</a>' .

            '<a href="' . makelink(array('a' => 'tree', 'p' => $page['project'], 'h' => $l['tree'], 'hb' => $l['commit_id'])) . '" class="tree" title="Tree">' .
                '<img alt="tree" src="img/silk/chart_organisation.png" />' .
            '</a>' .

            '<a href="' . makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $l['tree'], 'hb' => $l['commit_id'], 't' => 'targz')) . '" rel="nofollow" class="tar" title="tar/gz">' .
                '<img alt="tar/gz" src="img/silk/page_white_compressed.png" />' .
            '</a>' .

            '<a href="' . makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $l['tree'], 'hb' => $l['commit_id'], 't' => 'zip')) . '" rel="nofollow" class="zip" title="zip">' .
                '<img alt="zip" src="img/silk/page_white_zip.png" />' .
            '</a>' .

            '<a href="' . makelink(array('a' => 'patch', 'p' => $page['project'], 'h' => $l['commit_id'])) . '" class="patch" title="Patch">' .
                '<img alt="patch" src="img/silk/page_white_code_red.png" />' .
            '</a>' .
        '</td>' .
    '';
    */

    $page['lasthash'] = $l['commit_id'];
    $first = false;
}

echo '</ol>';

if ($page['lasthash'] !== 'HEAD' && !isset($page['shortlog_no_more'])) {
    echo "<p>";

    for ($i = 0; $i < $page['pg']; $i++) {
        echo "<a href=\"". makelink(array('a' => 'commits', 'p' => $page['project'], 'h' => $page['ref'], 'pg' => $i)) ."\">$i</a> ";
    }

    echo "<a href=\"". makelink(array('a' => 'commits', 'p' => $page['project'], 'h' => $page['ref'], 'pg' => $page['pg'] + 1)) ."\">more &raquo;</a>";
    echo "</p>";
}

echo '</div>';
