<?php
function divi__child_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'divi__child_theme_enqueue_styles' );

function my_scripts_method() {
    wp_enqueue_script(
        'custom-script',
        get_stylesheet_directory_uri() . '/custom/js/scripts.js',
        array ( 'jquery' )
    );
}
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

/* enqueue java if needed */
/*
function my_scripts_method() {
    wp_enqueue_script(
        'custom-script',
        get_stylesheet_directory_uri() . '/custom/rmm-blog.js',
        array( 'jquery' )
    );
}
add_action( 'wp_enqueue_scripts', 'my_scripts_method' ); */


//you can add custom functions below this line:
//require_once(get_stylesheet_directory().'/custom/reach-CTAs.php');
require_once(get_stylesheet_directory().'/custom/language.php');
require_once(get_stylesheet_directory().'/custom/divi.php');
