<?php

class TablesorterPlugin extends VGPlugin
{
	function __construct() {
		global $conf;
		if (isset($conf['tablesorter'])) {
			$this->register_hook('header');
		}
	}

	function hook($type) {
		if ($type == 'header') {
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="plugins/tablesorter/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="plugins/tablesorter/js/jquery.cookie.js"></script>
<script type="text/javascript" src="plugins/tablesorter/js/jquery.tablesorter.cookie.js"></script>
<link rel="stylesheet" href="plugins/tablesorter/css/tablesorter.css" type="text/css" media="screen" charset="utf-8" />
<script type="text/javascript" charset="utf-8">
/* <![CDATA[ */

$(document).ready(function() {
	$('table').tablesorter( { widgets: ['sortPersist'] });
});

/* ]]> */
</script>
<?php
		}
	}
}

