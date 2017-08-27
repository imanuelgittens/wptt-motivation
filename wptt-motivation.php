<?php

/*
Plugin Name: WPTT Motivation
Plugin URI: https://github.com/imanuelgittens/wptt-motivation
Description: This is the first plugin developed by the WPTT Meetup Group for demonstration of how plugins are built.
Author: Imanuel Gittens
Version: 1.0
Author URI: https://github.com/imanuelgittens
*/

$response = wp_remote_get('https://jsonplaceholder.typicode.com/posts/1');

if ( is_array( $response ) && ! is_wp_error( $response ) ) {
    $body = $response['body']; // use the content  
    $json = json_decode($body, true);
    $quote = $json['body'];
}

//function for adding quote to page
function display_quote() {
	global $quote;
	echo "<p id='wptt-quote'>$quote</p>";
}

// Now we set that function up to execute when the admin_footer action is called
add_action('admin_footer_text', 'display_quote');
// We need some CSS to position the paragraph
function wptt_quote_style() {
	echo "
	<style type='text/css'>
	#wptt-quote {
	    background-color: #3273dc;
	    border-radius: 3px;
	    color: #fff;
	    font-size: 16px;
	    max-width: 100em;
        padding: 10px;
		position: absolute;
		right: 1em;
		top: 2.3em;
	}
	</style>
	";
}
add_action('admin_head', 'wptt_quote_style');

?>