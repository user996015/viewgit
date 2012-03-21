<?php
echo '<div class="summary">';

require_once('templates/commits.php');
require_once('templates/tags.php');
require_once('templates/heads.php');

// call plugins that register "summary" hook
if (in_array('summary', array_keys(VGPlugin::$plugin_hooks))) {
    VGPlugin::call_hooks('summary');
}

echo '</div>';
