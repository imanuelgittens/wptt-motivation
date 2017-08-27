# wptt-motivation

First WordPress plugin built for teaching the Local Trinidad and Tobago WordPress Meetup about plugin development. Uses a motivational quote API and shows these quotes in the admin area (Built on top of Hello Dolly)

A WordPress Plugin is a program or a set of one or more functions written in the PHP scripting language, that adds a specific set of features or services to the WordPress site


1.Getting Started

To start creating a plugin, all we need to do is navigate to the `wp-content/plugins` folder and create our plugin folder and file. 

````

wptt-motivation
|
|
|-->wptt-motivation.php


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

[Smashing Magazine](https://www.smashingmagazine.com/2011/09/how-to-create-a-wordpress-plugin/)

[Scotch.io](https://scotch.io/tutorials/how-to-build-a-wordpress-plugin-part-1)
