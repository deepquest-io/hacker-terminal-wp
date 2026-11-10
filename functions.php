<?php
/**
 * DeepQuest Terminal Theme Functions
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
        '1.6.0'
    );

    wp_enqueue_script(
        'deepquest-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],        // no jQuery dependency — vanilla JS
        '1.6.0',
        true       // load in footer
    );

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
 * REST API endpoint: defacement post count
 * GET /wp-json/deepquest/v1/defacement-count
 */
function deepquest_register_rest_routes() {
    register_rest_route( 'deepquest/v1', '/defacement-count', [
        'methods'             => 'GET',
        'callback'            => 'deepquest_defacement_count_callback',
        'permission_callback' => '__return_true',
    ] );
}
add_action( 'rest_api_init', 'deepquest_register_rest_routes' );

function deepquest_defacement_count_callback() {
    $q = new WP_Query( [
        'post_type'      => 'post',
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'tax_query'      => [
            'relation' => 'OR',
            [
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => 'defacement',
            ],
            [
                'taxonomy' => 'post_tag',
                'field'    => 'slug',
                'terms'    => 'defacement',
            ],
        ],
    ] );
    return rest_ensure_response( [ 'count' => (int) $q->found_posts ] );
}
