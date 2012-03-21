<!doctype html>
<html id="top">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title><?php echo $page['title']; ?></title>
    <link rel="stylesheet" href="css/reset.css" type="text/css" />
    <link rel="stylesheet" href="css/<?php echo $conf['style']; ?>.css" type="text/css" />
    <link rel="icon" type="image/png" href="favicon.png" />
<?php
if (isset($page['project'])) {
    echo "\t<link rel=\"alternate\" type=\"application/rss+xml\" title=\"". htmlentities_wrapper($page['project']) ." log\" href=\"". makelink(array('a' => 'rss-log', 'p' => $page['project'])) ."\" />\n";
}
?>
    <meta name="generator" content="ViewGit" />
<?php VGPlugin::call_hooks('header'); ?>
</head>
<body class="<?php echo $page['action']; ?>-page">

<?php
VGPlugin::call_hooks('page_start');
if (isset($page['notices'])) {
    echo '<div class="notices">';
    foreach ($page['notices'] as $n) {
        echo "<p class=\"$n[class]\">". htmlentities_wrapper($n['message']) ."</p>";
    }
    echo '</div>';
}
?>

<div class="nav">
    <a href=".">Projects</a>
<?php
if (isset($page['project'])) {
    echo " &raquo; <a href=\"". makelink(array('a' => 'summary', 'p' => $page['project'])) ."\">$page[project]</a>";
    $projconf = $conf['projects'][$page['project']];
    if ($projconf['www']) {
        tpl_extlink($projconf['www']);
    }
}

if (isset($page['subtitle'])) {
    echo ' &raquo; ' . $page[subtitle];
}

if (isset($page['path'])) {
    if (isset($page['pathinfo'])) {
        echo ' ';
        $f = '';
        foreach ($page['pathinfo'] as $p) {
            if (strlen($f) > 0) { $f .= '/'; }
            $f .= "$p[name]";
            echo "/ <a href=\"". makelink(array('a' => ($p['type'] === 'tree' ? 'tree' : 'viewblob'), 'p' => $page['project'], 'h' => $p['hash'], 'hb' => $page['commit_id'], 'f' => $f)) ."\">$p[name]</a> ";
        }
    }
}
?>
</div>

<?php
echo '<div id="page_body">';

if (isset($page['project'])) {

    $page['links'] = array(
        'summary' => array(),
        'files' => array('h' => $page['tree_id'], 'hb' => $page['commit_id']),
        'commits' => array(),
        'commit' => array('h' => $page['commit_id']),
    );

    VGPlugin::call_hooks('pagenav');

    echo
        '<div class="pagenav">' .
            '<ul>' .
            '';

    foreach ($page['links'] as $link => $params) {
        $class = $page['action'] === $link ? ' class="active"' : '';

        echo
            '<li' . $class . '>' .
                '<a href="' . makelink(array_merge(array('a' => $link, 'p' => $page['project']), $params)) . '">' .
                    ucfirst($link) .
                '</a>' .
            '</li>' .
            '';
    }

    echo
            '</ul>' .

            /*
            '<form action="?" method="get" class="search">' .
                '<input type="hidden" name="a" value="search" />' .
                '<input type="hidden" name="p" value="' . $page['project'] . '" />' .
                '<input type="hidden" name="h" value="' . $page['commit_id'] . '" />' .

                '<select name="st">' .
                '';

    $opts = array('commit', 'change', 'author', 'committer');

    foreach ($opts as $opt) {
        echo
            '<option' .
                (isset($page['search_t']) && $opt == $page['search_t'] ? ' selected="selected"' : '') .
                '>' .
                $opt .
            '</option>' .
            '';
    }

    echo
                '</select>' .

                '<input type="text" name="s"' .
                    (isset($page['search_s']) ?  ' value="' . htmlentities_wrapper($page['search_s']) .
                    '"' : '') . ' />' .

            '</form>' .
            */
        '</div>' .
        '';
}
