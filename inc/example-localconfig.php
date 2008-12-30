<?php
/** @file
 * Example localconfig.php. See config.php for more information.
 */

// This is the only mandatory setting
$conf['projects'] = array(
	'foo' => array('repo' => '/home/user/projects/foo/.git'),
);

// A bit sorter datetime format: YY-MM-DD HH:MM
$conf['datetime'] = '%y-%m-%d %H:%M';

// Extra security
$conf['allow_checkout'] = false;


// authenticate using some drupal site's config
$conf['drupal_site_config']='/var/www/sites/default/settings.php';
$conf['auth_lib']='drupal_user';
