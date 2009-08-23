<?php
global $wpdb;
define('CAL_ICON_URL', get_option('siteurl').'/wp-content/plugins/DM-Archives/images/cal_icon.png');
$mnthsql = "SELECT DISTINCT Monthname(post_date) as post_month, Year(post_date) as post_year FROM $wpdb->posts where post_status = 'publish' AND post_type = 'post' AND Year(post_date) <= Year(now()) ORDER BY post_date DESC";
$months = $wpdb->get_results($mnthsql);
$output = $pre_HTML;
$output .= "\n<ul class='archivemonths'>";
foreach ($months as $month) {
	$output .= "\n<li>";
	if(get_option('dm_img_option','false') == "true") {
		$imgurl = "<img style='margin-bottom: -2px;' src=\"".CAL_ICON_URL."\" />&nbsp;";
	} else {
		$imgurl = "";
	}
	$output .= "<h4>$imgurl $month->post_month, $month->post_year</h4>";
	if(get_option('dm_excerpts_option','false') == "true") {
		$sql = "SELECT DISTINCT ID, post_title, Day(post_date) as post_day, comment_count, post_excerpt FROM $wpdb->posts where post_type = 'post' AND post_status = 'publish' AND post_title <> '' AND Year(post_date) = '".$month->post_year."' AND Monthname(post_date) = '".$month->post_month."' ORDER BY post_date DESC";
	} else if(get_option('dm_excerpts_option','false') == "false") {
		$sql = "SELECT DISTINCT ID, post_title, Day(post_date) as post_day, comment_count FROM $wpdb->posts where post_type = 'post' AND post_status = 'publish' AND post_title <> '' AND Year(post_date) = '".$month->post_year."' AND Monthname(post_date) = '".$month->post_month."' ORDER BY post_date DESC";
	}
	$results = $wpdb->get_results($sql);
	$output .= "\n\t<ul class='archivedays'>";
	foreach ($results as $result) {
		$output .= "\n\t<li><p>".date("jS", mktime(0,0,0,0,$result->post_day,0000))."</span>: <a href=\"".get_permalink($result->ID)."\">$result->post_title</a> ($result->comment_count)</p>";
		if(trim($result->post_excerpt) != "") {
			$output .= "<p><i>$result->post_excerpt</i></p></li>";
		} else {
			$output .= "</li>";
		}
	}
	$output .= "\n\t</ul>\n</li>";
}
$output .= "\n</ul>";
echo $output;

?>