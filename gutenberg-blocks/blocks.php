<?php

if (!defined('ABSPATH')) exit;

function affiliatepress_block_editor_assets()
{
    $url = get_template_directory_uri() . "/gutenberg-blocks/";

    $asset_file = include(get_template_directory() . "/gutenberg-blocks/" . 'build/index.asset.php');

    // Scripts.
    wp_enqueue_script(
        'affiliatepress-block-js', // Handle.
        $url . 'build/index.js',
        $asset_file['dependencies'],
        $asset_file["version"]
    );

    // Styles.
    wp_enqueue_style(
        'affiliatepress-block-editor-css', // Handle.
        $url . 'build/editor.css',
        array('wp-edit-blocks')
    );
}

add_action('enqueue_block_editor_assets', 'affiliatepress_block_editor_assets');

function affiliatepress_block_assets()
{
    $url = get_template_directory_uri() . "/gutenberg-blocks/";

    echo '<link rel="stylesheet" href="' . $url . 'build/style.css' . '" type="text/css" media="print" onload="this.media=`all`" />';
}

add_action('enqueue_block_assets', 'affiliatepress_block_assets');
