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

/**
 * SW61 — Block Styles
 * Enregistrement des variantes de blocs pour l'éditeur WP
 * À intégrer dans functions.php du thème enfant
 */

add_action( 'init', 'sw61_register_block_styles' );

function sw61_register_block_styles() {

    // ─────────────────────────────────────────
    // BOUTONS — 4 variantes
    // ─────────────────────────────────────────

    register_block_style( 'core/button', [
        'name'  => 'outline',
        'label' => 'Outline',
    ] );

    register_block_style( 'core/button', [
        'name'  => 'ghost',
        'label' => 'Ghost',
    ] );

    register_block_style( 'core/button', [
        'name'  => 'corail',
        'label' => 'Corail',
    ] );

    register_block_style( 'core/button', [
        'name'  => 'inverse',
        'label' => 'Inversé',
    ] );

    // ─────────────────────────────────────────
    // GROUPES — 4 sections
    // ─────────────────────────────────────────

    register_block_style( 'core/group', [
        'name'  => 'claire',
        'label' => 'Claire',
    ] );

    register_block_style( 'core/group', [
        'name'  => 'sombre',
        'label' => 'Sombre',
    ] );

    register_block_style( 'core/group', [
        'name'  => 'vert',
        'label' => 'Vert',
    ] );

    register_block_style( 'core/group', [
        'name'  => 'corail',
        'label' => 'Corail',
    ] );
}
