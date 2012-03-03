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
                ago($page['author_datetime']) .
                ' ago' .
            '</span>' .

            '<a class="commit" href="">' .
                'commit ' .
                '<span>' .
                    $page['hash'] .
                '</span>' .
            '</a>' .
        '</div>' .
    '</div>' .
    '';
