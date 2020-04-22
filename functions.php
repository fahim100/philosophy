<?php

require_once ( get_theme_file_path( "/inc/tgm.php" ) );
require_once ( get_theme_file_path( "/inc/attachments.php" ) );

if( site_url( "http://localhost/test-theme" ) ){
    define( "VERSION", time() );
} else {
    define( "VERSION", wp_get_theme() -> get( "Version" ) );
}

function philosophy_theme_setup()
{
    load_theme_textdomain( "philosophy" );
    add_theme_support( "post-thumbnails" );
    add_theme_support( "title-tag" );
    add_theme_support( 'post-formats', array ( 'video', 'gallery', 'quote', 'image', 'audio', 'link' ) );
    add_theme_support( 'html5', array( 'comment-list', 'search-form' ) );
    add_editor_style( "/assets/css/editor-style.css" );

    register_nav_menu( "topmenu", __( "Top Menu", "philosophy" ) );
    add_image_size( "philosophy_square_image", 400, 400, true );
}
add_action( "after_setup_theme", "philosophy_theme_setup" );

function philosophy_assets(){
    // css-ecqueue
    wp_enqueue_style( "font-awesome-css", get_template_directory_uri() . "/assets/css/font-awesome/css/font-awesome.min.css" , null, "1.0" );
    wp_enqueue_style( "fonts-css", get_template_directory_uri() . "/assets/css/fonts.css" , null, "1.0" );
    wp_enqueue_style( "philosophy-base-css", get_template_directory_uri() . "/assets/css/base.css" , null, "1.0" );
    wp_enqueue_style( "philosophy-vendor-css", get_template_directory_uri() . "/assets/css/vendor.css" , null, "1.0" );
    wp_enqueue_style( "philosophy-main-css", get_template_directory_uri() . "/assets/css/main.css" , null, "1.0" );
    wp_enqueue_style( "philosophy-main-css", get_stylesheet_uri(), null, VERSION );

    // JS enqueue
    wp_enqueue_script( "philosophy-modernizr-js", get_template_directory_uri() . "/assets/js/modernizr.js", null, "1.0" );
    wp_enqueue_script( "philosophy-pace-js", get_template_directory_uri() . "/assets/js/pace.min.js", null, "1.0" );
    wp_enqueue_script( "philosophy-plugins-js", get_template_directory_uri() . "/assets/js/plugins.js", array( "jquery" ), "1.0", true );
    wp_enqueue_script( "philosophy-main-js", get_template_directory_uri() . "/assets/js/main.js", array( "jquery" ), "1.0", true );
}
add_action( "wp_enqueue_scripts", "philosophy_assets" );

// Add classes in navigation
function philosophy_add_class( $classes, $item ){
    if( in_array( 'menu-item-has-children', $classes ) ){
        $classes[] = "has-children";
    }
    return $classes;
}
add_filter( "nav_menu_css_class", "philosophy_add_class", 10, 2);

function philosophy_paginate(){

    global $wp_query;

    $links = paginate_links( array(
        'current' => max( 1, get_query_var( "paged" ) ),
        'total' => $wp_query->max_num_pages,
        'type' => 'list'
    ) );

    $links = str_replace( "page-numbers", "pgn__num", $links );
    $links = str_replace( "<ul class='pgn__num'>", "<ul>", $links );
    $links = str_replace( "next pgn__num", "pgn__next", $links );
    $links = str_replace( "prev pgn__num", "pgn__prev", $links );

    echo $links;

}
