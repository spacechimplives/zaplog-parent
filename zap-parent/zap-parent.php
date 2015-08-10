<?php
/*
* Plugin Name: Zaplog Parent 
* Description: Zaplog Aggregator 
* Text Domain: zaplog
*/


foreach(glob(plugin_dir_path( __FILE__ )."inc/*.php") as $file){
    require_once $file;
}


//**Add tables
//add usermeta (keys & domains)

//**Add Meta Fields
//burl & purl
//Add meta boxes to display votes












//**Settings Menu
//Autopublish Zaps?
//Blacklist (from list of all zappers)
//Frontpage Algorithms
