<?php
echo
    '<div class="commitmessage">' .
        '<pre>' .
            //htmlentities_wrapper($page['message_full']) .
            htmlentities_wrapper($page['message_firstline']) .
        '</pre>' .

        '<div class="authorinfo">' .
            '<span class="author">' .
                format_author($page['author_name']) .
            '</span>' .

            '<span class="age">' .
                'authored ' .
                datetimeFormatDuration(time() - strtotime(htmlentities_wrapper($page['author_datetime']))) .
                ' ago' .
            '</span>' .

            '<span class="commit">' .
                'commit ' .
                '<a href="">' .
                    $page['hash'] .
                '</a>' .
            '</span>' .
        '</div>' .
    '</div>' .
    '';
