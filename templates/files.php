<?php
echo
    '<div class="files">' .
        '<table>' .
            '<thead>' .
                '<tr>' .
                    '<th class="name">Name</th>' .
                    '<th class="age">Age</th>' .
                    '<th class="message">Message</th>' .
                    //<th class="download">Download</th>' .
                '</tr>' .
            '</thead>' .
            '<tbody>' .
                '';

$entries = $page['entries'];
$folders = array();
$files = array();

foreach ($entries as $e) {
    if ($e['type'] === 'tree') {
        $folders[] = $e;
    }
    else {
        $files[] = $e;
    }
}

$sorted_entries = array_merge($folders, $files);

foreach ($sorted_entries as $e) {
    $tr_class = $tr_class == 'odd' ? 'even' : 'odd';

    if (strlen($page['path']) > 0) {
        $path = $page['path'] .'/'. $e['name'];
    }
    else {
        $path = $e['name'];
    }

    $safe_name = htmlspecialchars($e['name']);
    $type = $e['type'] === 'blob' ? 'blob' : 'dir';
    $class = $type . ' ' . $tr_class;
    $title = '[' . $e['mode'] . '] ' . $safe_name;
    $author = $e['author'];
    $message = $e['message'] . ' [' . format_author($author) . ']';

    if ($type === 'blob') {
        $link = makelink(array('a' => 'viewblob', 'p' => $page['project'], 'h' => $e['hash'], 'hb' => $page['commit_id'], 'f' => $path));
        $age = $e['age'];
        $download_link = makelink(array('a' => 'blob', 'p' => $page['project'], 'h' => $e['hash'], 'n' => $e['name']));
        $download = '<a href="' . $download_link  . '">blob</a>';
    }
    else {
        $link = makelink(array('a' => 'tree', 'p' => $page['project'], 'h' => $e['hash'], 'hb' => $page['commit_id'], 'f' => $path));
        $age = $e['age'];
        $download =
            '<a href="' . makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $e['hash'], 'hb' => $page['commit_id'], 't' => 'targz', 'n' => $e['name'])) . '" class="tar_link" title="tar/gz">tar.gz</a>' .
            '<a href="' . makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $e['hash'], 'hb' => $page['commit_id'], 't' => 'zip', 'n' => $e['name'])) . '" class="zip_link" title="zip">zip</a>' .
            '';
    }

    $name = '<a href="' . $link . '" title="' . $title . '">' . $safe_name . '</a>';

    echo
        '<tr class="' . $class . '">' .
            '<td class="name">' .
                $name .
            '</td>' .
            '<td class="age">' .
                $age .
            '</td>' .
            '<td class="message">' .
                $message .
            '</td>' .
            //'<td class="download">' .
                //$download .
            //'</td>' .
        '</tr>' .
        '';
}

echo
            '</tbody>' .
        '</table>' .

        '<p>' .
            'Download as ' .
            '<a href="' . makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $page['tree_id'], 'hb' => $page['commit_id'], 't' => 'targz')) . '" rel="nofollow">' .
                'tar.gz' .
            '</a>' .
            ' or ' .
            '<a href="' . makelink(array('a' => 'archive', 'p' => $page['project'], 'h' => $page['tree_id'], 'hb' => $page['commit_id'], 't' => 'zip')) . '" rel="nofollow">' .
                'zip' .
            '</a>' .
            '. Browse this tree at the ' .

            '<a href="' . makelink(array('a' => 'tree', 'p' => $page['project'], 'hb' => 'HEAD', 'f' => $page['path'])) . '">' .
                'HEAD' .
            '</a>' .
            '.' .
        '</p>' .
    '</div>' .
    '';
