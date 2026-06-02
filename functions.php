<?php
/**
 * SW61 1.0 — functions.php
 * Thème enfant de Twenty Twenty-Five
 */

// Enqueue styles parent + enfant
add_action( 'wp_enqueue_scripts', 'sw61_enqueue_styles' );
function sw61_enqueue_styles() {
    wp_enqueue_style(
        'twentytwentyfive-style',
        get_template_directory_uri() . '/style.css'
    );
    wp_enqueue_style(
        'sw61-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'twentytwentyfive-style' ),
        wp_get_theme()->get( 'Version' )
    );
}
