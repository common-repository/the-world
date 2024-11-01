<?php
/*
Plugin Name: The World
Version: 0.4
Plugin URI: http://doa.travel/plugin/
Description: This plugin maps wherever you've been around the world.
Author: doatv
Author URI: http://doa.travel/
*/

require_once('theworld-setting.php');
require_once("theworld-main.php");
require_once("theworld-widget.php");
require_once("theworld-shortcode.php");

function the_world_admin_menu(){
	add_menu_page("The World", "The World", 1, "TheWorld", "theworld_setting", plugins_url('images/icon.png', __FILE__));
}
add_action('admin_menu', 'the_world_admin_menu');

function the_world_map(){
  $the_world = new TheWorld();
  echo($the_world->chartImg());
}

function the_world_init(){
  $base_options = array(
    'classname' => 'sidebar-content-widget',
    'description' => 'The World Widget.'
  );
}

add_action('plugins_loaded','the_world_init');
add_action('widgets_init', create_function('', 'return register_widget("TheWorldWidget");'));
