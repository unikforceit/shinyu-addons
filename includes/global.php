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
// Add new column to custom post type
add_filter( 'manage_elementor_library_posts_columns', 'add_shortcode_column' );
function add_shortcode_column( $columns ) {
    $columns['shortcode'] = 'Shortcode';
    return $columns;
}
// Populate shortcode column with post shortcode
add_action( 'manage_elementor_library_posts_custom_column', 'populate_shortcode_column', 10, 2 );
function populate_shortcode_column( $column, $post_id ) {
    if ( 'shortcode' === $column ) {
        echo '[shinyu_template id="' . $post_id . '"]';
    }
}
// Register shortcode for custom post type
add_shortcode( 'shinyu_template', 'shinyu_display_custom_post_type' );
function shinyu_display_custom_post_type( $atts ) {
    $atts = shortcode_atts( array(
        'id' => ''
    ), $atts );

    $query = new WP_Query( array(
        'post_type' => 'elementor_library',
        'p' => $atts['id']
    ) );

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            the_content();
        }
        wp_reset_postdata();
    }
}
