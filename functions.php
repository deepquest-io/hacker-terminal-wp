<?php
/**
 * Retro Hacker Terminal Theme Functions
 */
require_once get_template_directory() . '/inc/fallback-menu.php';

// Theme setup
function deepquest_setup() {
    load_theme_textdomain( 'deepquest-terminal', get_template_directory() . '/languages' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form','comment-form','comment-list','gallery','caption','style','script' ] );
    add_theme_support( 'custom-logo', [ 'height'=>80,'width'=>200,'flex-width'=>true,'flex-height'=>true ] );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'responsive-embeds' );

    add_image_size( 'deepquest-card', 800, 400, true );

    register_nav_menus( [
        'primary' => esc_html__( 'Primary Menu', 'deepquest-terminal' ),
        'footer'  => esc_html__( 'Footer Menu', 'deepquest-terminal' ),
    ] );
}
add_action( 'after_setup_theme', 'deepquest_setup' );

// Enqueue styles and scripts
function deepquest_scripts() {
    wp_enqueue_style(
        'deepquest-style',
        get_stylesheet_uri(),
        [],
        '1.9.0'
    );

    wp_enqueue_script(
        'deepquest-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],        // no jQuery dependency — vanilla JS
        '1.9.0',
        true       // load in footer
    );

    if ( is_404() ) {
        wp_enqueue_script(
            'deepquest-404',
            get_template_directory_uri() . '/assets/js/404.js',
            [],
            '1.9.0',
            true
        );
    }

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'deepquest_scripts' );

// Content width
function deepquest_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'deepquest_content_width', 820 );
}
add_action( 'after_setup_theme', 'deepquest_content_width', 0 );

// Register sidebar
function deepquest_widgets_init() {
    register_sidebar( [
        'name'          => esc_html__( 'Sidebar', 'deepquest-terminal' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'deepquest-terminal' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ] );
}
add_action( 'widgets_init', 'deepquest_widgets_init' );

// Excerpt
function deepquest_excerpt_length( $length ) { return 30; }
add_filter( 'excerpt_length', 'deepquest_excerpt_length', 999 );

function deepquest_excerpt_more( $more ) { return '...'; }
add_filter( 'excerpt_more', 'deepquest_excerpt_more' );

// Body classes
function deepquest_body_classes( $classes ) {
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }
    return $classes;
}
add_filter( 'body_class', 'deepquest_body_classes' );

/**
 * Customizer: terminal counter widget (shown in the default sidebar)
 */
function deepquest_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'deepquest_counter', [
        'title'    => esc_html__( 'Terminal Counter', 'deepquest-terminal' ),
        'priority' => 160,
    ] );

    $wp_customize->add_setting( 'deepquest_counter_title', [
        'default'           => 'POST_LOG',
        'sanitize_callback' => 'sanitize_text_field',
    ] );
    $wp_customize->add_control( 'deepquest_counter_title', [
        'label'   => esc_html__( 'Counter title', 'deepquest-terminal' ),
        'section' => 'deepquest_counter',
        'type'    => 'text',
    ] );

    $wp_customize->add_setting( 'deepquest_counter_category', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_title',
    ] );
    $wp_customize->add_control( 'deepquest_counter_category', [
        'label'       => esc_html__( 'Category slug to count', 'deepquest-terminal' ),
        'description' => esc_html__( 'Leave empty to count all published posts.', 'deepquest-terminal' ),
        'section'     => 'deepquest_counter',
        'type'        => 'text',
    ] );
}
add_action( 'customize_register', 'deepquest_customize_register' );
