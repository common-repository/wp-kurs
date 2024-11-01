<?php
/*
Plugin Name: WP Kurs
Version: 1.1
Plugin URI: http://ahlul.web.id
Description: Show Indonesian Banks Rates on your Blog
Author: Ahlul Faradish
*/

$content_kurs = file_get_contents("http://serviceforweb.com/kurs/simple-c.php");
$header_kurs = file_get_contents("http://serviceforweb.com/kurs/header.php");

function kurs_load() {
	global $header_kurs;
	echo $header_kurs;
}

$pcontent = $content_kurs."<p>&nbsp;</p>";
function filter_wpKurs($content) {
	global $pcontent;
	$content = str_replace("[wpkurs]", $pcontent, $content);
	return $content;
}


function wp_kurs() {
	global $pcontent;
	echo $pcontent;
}

function widget_wpKurs($args) {
  extract($args);
  ?>
  <h2 class="widgettitle">Indonesian Rates</h2>
  <?php wp_kurs(); ?>
  <?php
}


function wpKurs_init()
{
  register_sidebar_widget(__('Wp Kurs Widget'), 'widget_wpKurs');
}

add_action("plugins_loaded", "wpKurs_init");
add_action('wp_head', 'kurs_load');
add_filter('the_content', 'filter_wpKurs');
?>