<?php
/**
 * ATB Corporate WordPress Theme Functions
 * @package ATB_Corporate
 */

// Theme setup
add_action('after_setup_theme', 'atb_theme_setup');
function atb_theme_setup() {
    // Add support for automatic feed links
    add_theme_support('automatic-feed-links');
    
    // Add support for post thumbnails
    add_theme_support('post-thumbnails');
    
    // Register navigation menus
    register_nav_menus([
        'primary' => esc_html__('Primary Menu', 'atb-corporate'),
        'mobile' => esc_html__('Mobile Menu', 'atb-corporate'),
        'footer' => esc_html__('Footer Menu', 'atb-corporate'),
    ]);
    
    // Add text domain for translations
    load_theme_textdomain('atb-corporate', get_template_directory() . '/languages');
}

// Enqueue stylesheets and scripts
add_action('wp_enqueue_scripts', 'atb_enqueue_scripts');
function atb_enqueue_scripts() {
    // Load stylesheets
    wp_enqueue_style('atb-styles', get_template_directory_uri() . '/assets/atb-styles.css', [], '1.0.0');
    
    // Load JavaScript
    wp_enqueue_script('atb-main', get_template_directory_uri() . '/assets/atb-main.js', [], '1.0.0', true);
    
    // Load jQuery for navigation toggle
    wp_enqueue_script('jquery');
}

// Register widget area
add_action('widgets_init', 'atb_widgets_init');
function atb_widgets_init() {
    register_sidebar([
        'name'          => esc_html__('Sidebar', 'atb-corporate'),
        'id'            => 'sidebar',
        'description'   => esc_html__('Main sidebar', 'atb-corporate'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
}

// Custom nav walker for dropdown menus
class ATB_Nav_Walker extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = null ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );
        $output .= "{$n}{$indent}<ul class=\"nav__drop\">$n";
    }
}

// Admin customizations
add_action('admin_menu', 'atb_remove_default_menu_items');
function atb_remove_default_menu_items() {
    // Optionally remove default WordPress menu items
}

// Custom post type for services
add_action('init', 'atb_register_services_post_type');
function atb_register_services_post_type() {
    register_post_type('atb_service', [
        'label' => esc_html__('Services', 'atb-corporate'),
        'description' => esc_html__('ATB Advisory Services', 'atb-corporate'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'service'],
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'menu_icon' => 'dashicons-briefcase',
    ]);
}

// Custom post type for insights
add_action('init', 'atb_register_insights_post_type');
function atb_register_insights_post_type() {
    register_post_type('atb_insight', [
        'label' => esc_html__('Insights', 'atb-corporate'),
        'description' => esc_html__('Insights and Articles', 'atb-corporate'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'insight'],
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 6,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'menu_icon' => 'dashicons-lightbulb',
    ]);
}

// Custom categories for insights
add_action('init', 'atb_register_insight_taxonomy');
function atb_register_insight_taxonomy() {
    register_taxonomy('insight_category', 'atb_insight', [
        'hierarchical' => true,
        'label' => esc_html__('Insight Categories', 'atb-corporate'),
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'insight-category'],
    ]);
}