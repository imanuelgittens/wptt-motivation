# wptt-quotes

First WordPress plugin built for teaching the Local Trinidad and Tobago WordPress Meetup about plugin development. Uses a quote API and shows these quotes in the admin area (Built on top of Hello Dolly)

What is a WordPress plugin?

A WordPress Plugin is a program or a set of one or more functions written in the PHP scripting language, that adds a specific set of features or services to the WordPress site.


1.Getting Started

To start creating a plugin, all we need to do is navigate to the `wp-content/plugins` folder and create our plugin folder and file. 

````

wptt-quotes
|
|
|-->wptt-quotes.php


````

Within that file, we need to add the following code for WordPress to recogize it as a plugin. 

````

/*
Plugin Name: WPTT Motivation
Plugin URI: https://github.com/imanuelgittens/wptt-motivation
Description: This is the first plugin developed by the WPTT Meetup Group for demonstration of how plugins are built.
Author: Imanuel Gittens
Version: 1.0
Author URI: https://github.com/imanuelgittens
*/

````

With that, we've technically created our first plugin! But let's make it do something. 

We want to display quotes somewhere, so for that we'll need a function. We'll worry about where it is being displayed later on. 

````
//function for adding quote to page
function getQuote(){() {
	echo "To be or not to be? That is the question."
}

````

Now we must figure out where we want this to be shown. To interact with WordPress, we need to use its hooks and filters. You can see more on those [here](https://codex.wordpress.org/Plugin_API/Action_Reference)

We want to place our quote in the footer of the WordPress admin so we'll be using the `admin_footer_text` hook. 

````
add_action('admin_footer_text', 'getQuote');

````

Let's add a bit of styling to our quote. First we most adjust the quote string so that it is an HTML string. 

````
function getQuote(){() {
	echo "<p id="wptt-quote">To be or not to be? That is the question.</p>"
}
````

And now we can write a function that styles this quote by targetting it with CSS selectors and define how it looks. 

````
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
	}
	</style>
	";
}

add_action('admin_head', 'wptt_quote_style');
````

Next we must actually communicate with our API. The service we are using is [https://talaikis.com/random_quotes_api/](https://talaikis.com/random_quotes_api/). They give us random quotes. Let's adjust our get quotes function to get a quote from the API. 


````
function getQuote(){


		$response = wp_remote_get("https://talaikis.com/api/quotes/random/");

		if ( is_array( $response ) && ! is_wp_error( $response ) ) {
		    $body = $response["body"]; // use the content  
		    $json = json_decode($body, true);
		    echo $json["quote"];
		}
	
}
````

We have one problem. Most APIs don't allow us to make unlimited requests so we'll need to find a way to limit the amount of request we make. We'll make one request per day using a cookie. 

````
function getQuote(){
	$motivation_cookie_name = "wptt-motivate-cookie";
	if(!isset($_COOKIE[$motivation_cookie_name])){

		$response = wp_remote_get("https://talaikis.com/api/quotes/random/");

		if ( is_array( $response ) && ! is_wp_error( $response ) ) {
		    $body = $response["body"]; // use the content  
		    $json = json_decode($body, true);
		    $motivation_cookie_value = $json["quote"];
		}

		setcookie($motivation_cookie_name, $motivation_cookie_value, time() + (86400 * 7));
		echo "<p id='wptt-quote'>$motivation_cookie_value</p>";
		
	}else{
		echo "<p id='wptt-quote'>$_COOKIE[$motivation_cookie_name]</p>";
	}
	
}

````
And that's it! We've successfully built our first plugin.

For more details and further advancement of your plugin development skills, visit the links below.


[Smashing Magazine](https://www.smashingmagazine.com/2011/09/how-to-create-a-wordpress-plugin/)

[Scotch.io](https://scotch.io/tutorials/how-to-build-a-wordpress-plugin-part-1)
