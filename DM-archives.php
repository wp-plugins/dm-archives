<?php
/*
Plugin Name: 	DM Archives
Plugin URI: 	http://www.nischalmaniar.info/wordpress
Description:  	Displays archives of your entries grouped by month.
Author: 		Nischal Maniar
Author URI: 	http://www.nischalmaniar.info
Version: 		1.0
DM Archives is released under the GNU General Public License (GPL) http://www.gnu.org/licenses/gpl.txt
*/
function display_archives($content) {
	if(false !== strpos($content, '[dm-archives]'))
	{
		include('DM-get-archives.php');
	}
	else
	{
		return $content;
	}
}

function dm_archives_options() {
	include("DM-archives-options.php");
}

function add_dm_archives_options() {
	add_options_page('DM Archives Options', 'DM Archives', 8, __FILE__, 'dm_archives_options');
}

add_action('admin_menu', 'add_dm_archives_options');
add_filter('the_content','display_archives');

?>