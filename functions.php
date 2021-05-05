<?php
    // =========================================================================
    // AUTOLOADER
    // =========================================================================
    require_once __DIR__ . '/inc/autoloader.php';

    // =========================================================================
    // HELPER FUNCTIONS
    // =========================================================================
    require_once __DIR__ . '/inc/helpers.php';

    // =========================================================================
    // WORDPRESS HOOKS
    // =========================================================================
    require_once __DIR__ . '/inc/hooks.php';


    // =========================================================================
    // CUSTOM ENDPOINT FOR FACET FILTER DATA
    // =========================================================================
    add_action('rest_api_init', function () {
    register_rest_route( 'brewdaddy/v1', 'all', array(
                    'methods'  => 'GET',
                    'callback' => 'custom_endpoint_function'
        ));
    });

    function custom_endpoint_function( $data ) {
        global $wpdb;
        $query = "SELECT facet_name, facet_value, facet_display_value FROM `wp_facetwp_index`";
        $list = $wpdb->get_results($query);
        return $list;
    }