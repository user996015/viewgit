<?php
if ($conf['ad']) {
    echo "<div class=\"ad\"><a href=\"http://viewgit.fealdia.org/\" title=\"Visit the ViewGit homepage\">ViewGit</a></div>";
}

VGPlugin::call_hooks('footer');

echo
                '<div class="powered-by">' .
                    'Powered by <a href="http://viewgit.fealdia.org/">ViewGit</a> and<br />' .
                    'the <a href="https://github.com/user996015/viewgit/">ViewGit Enhancement Suite</a>.' .
                '</div>' .
            '</div>' .
        '</body>' .
    '</html>' .
    '';
