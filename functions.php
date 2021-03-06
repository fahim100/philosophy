<?php

require_once get_theme_file_path( "/inc/tgm.php" );
require_once get_theme_file_path( "/inc/attachments.php" );
require_once get_theme_file_path( "/widgets/social-widget.php" );

if ( site_url( "http://localhost/test-theme" ) ) {
    define( "VERSION", time() );
} else {
    define( "VERSION", wp_get_theme()->get( "Version" ) );
}

function philosophy_theme_setup() {
    load_theme_textdomain( "philosophy" );
    add_theme_support( "post-thumbnails" );
    add_theme_support( "title-tag" );
    add_theme_support( "custom-logo" );
    add_theme_support( 'post-formats', array( 'video', 'gallery', 'quote', 'image', 'audio', 'link' ) );
    add_theme_support( 'html5', array( 'comment-list', 'search-form' ) );
    add_editor_style( "/assets/css/editor-style.css" );

    register_nav_menu( "topmenu", __( "Top Menu", "philosophy" ) );
    register_nav_menu( "quicklinkmenu", __( "Quick Link Menu", "philosophy" ) );
    register_nav_menu( "archivemenu", __( "Archive Menu", "philosophy" ) );
    register_nav_menu( "socialmenu", __( "Social Menu", "philosophy" ) );
    add_image_size( "philosophy_square_image", 400, 400, true );
}
add_action( "after_setup_theme", "philosophy_theme_setup" );

function philosophy_assets() {
    // css-ecqueue
    wp_enqueue_style( "font-awesome-css", get_template_directory_uri() . "/assets/css/font-awesome/css/font-awesome.min.css", null, "1.0" );
    wp_enqueue_style( "fonts-css", get_template_directory_uri() . "/assets/css/fonts.css", null, "1.0" );
    wp_enqueue_style( "philosophy-base-css", get_template_directory_uri() . "/assets/css/base.css", null, "1.0" );
    wp_enqueue_style( "philosophy-vendor-css", get_template_directory_uri() . "/assets/css/vendor.css", null, "1.0" );
    wp_enqueue_style( "philosophy-main-css", get_template_directory_uri() . "/assets/css/main.css", null, "1.0" );
    wp_enqueue_style( "philosophy-style-css", get_stylesheet_uri(), null, VERSION );

    // JS enqueue
    wp_enqueue_script( "philosophy-modernizr-js", get_template_directory_uri() . "/assets/js/modernizr.js", null, "1.0" );
    wp_enqueue_script( "philosophy-pace-js", get_template_directory_uri() . "/assets/js/pace.min.js", null, "1.0" );
    wp_enqueue_script( "philosophy-plugins-js", get_template_directory_uri() . "/assets/js/plugins.js", array( "jquery" ), "1.0", true );
    wp_enqueue_script( "philosophy-main-js", get_template_directory_uri() . "/assets/js/main.js", array( "jquery" ), "1.0", true );
}
add_action( "wp_enqueue_scripts", "philosophy_assets" );

// Add classes in navigation
function philosophy_add_class( $classes, $item ) {
    if ( in_array( 'menu-item-has-children', $classes ) ) {
        $classes[] = "has-children";
    }
    return $classes;
}
add_filter( "nav_menu_css_class", "philosophy_add_class", 10, 2 );

function philosophy_paginate() {

    global $wp_query;

    $links = paginate_links( array(
        'current' => max( 1, get_query_var( "paged" ) ),
        'total'   => $wp_query->max_num_pages,
        'type'    => 'list',
    ) );

    $links = str_replace( "page-numbers", "pgn__num", $links );
    $links = str_replace( "<ul class='pgn__num'>", "<ul>", $links );
    $links = str_replace( "next pgn__num", "pgn__next", $links );
    $links = str_replace( "prev pgn__num", "pgn__prev", $links );

    echo $links;

}

remove_action( "term_description", "wpautop" );

function philosophy_widgets() {
    register_sidebar( array(
        'name'          => __( 'About Page Widget', 'philosophy' ),
        'id'            => 'about_page_widget',
        'description'   => __( 'Widgets in this area will be shown under about page.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="col-block">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="quarter-top-margin">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Contact Map Widget', 'philosophy' ),
        'id'            => 'contact_map',
        'description'   => __( 'Widgets in this area will be shown under contact page.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => '',
    ) );

    register_sidebar( array(
        'name'          => __( 'Contact Info Widget', 'philosophy' ),
        'id'            => 'contact_info',
        'description'   => __( 'Widgets in this area will be shown under contact page.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="col-block %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="quarter-top-margin">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Before Footer Widget', 'philosophy' ),
        'id'            => 'before_footer',
        'description'   => __( 'Widgets in this area will be shown under before footer.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Copyright Widget', 'philosophy' ),
        'id'            => 'footer_copyright',
        'description'   => __( 'Widgets in this area will be shown in footer.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Right Widget', 'philosophy' ),
        'id'            => 'footer_right',
        'description'   => __( 'Widgets in this area will be shown in footer right.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Header Section Widget', 'philosophy' ),
        'id'            => 'header_section',
        'description'   => __( 'Widgets in this area will be shown in header.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'philosophy_widgets' );

function philosophy_search_form() {
    $homedir = home_url( "/" );
    $label = __( "Search for:", "philosophy" );
    $btn_search = __( "Search", "philosophy" );
    $newForm = <<<FORM
    <form role="search" method="get" class="header__search-form" action="{$homedir}">
        <label>
            <span class="hide-content">{$label}</span>
            <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="{$label}" autocomplete="off">
        </label>
        <input type="submit" class="search-submit" value="{$btn_search}">
    </form>
    FORM;

    return $newForm;
}
add_filter( "get_search_form", "philosophy_search_form" );