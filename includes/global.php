<?php
/**
 * Enqueue JavaScript and CSS files for the plugin
 */
function shyinu_addons_enqueue_scripts()
{
    wp_enqueue_script('jquery-ui-slider');
    // Enqueue JavaScript file
    wp_enqueue_script('shyinu-addons-plugin', ShyinuAddons_PLUG_URL . 'includes/assets/global/global.js', array('jquery'), '1.0', true);

    // Enqueue CSS file
    wp_enqueue_style('shyinu-addons-plugin', ShyinuAddons_PLUG_URL . 'includes/assets/global/global.css', array(), '1.0', 'all');
}

add_action('wp_enqueue_scripts', 'shyinu_addons_enqueue_scripts');
