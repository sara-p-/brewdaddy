<?php
    class WP_Boilerplate_TAX {    
        // Register Custom Taxonomy
        static function beer_style() {
            $labels = [
                'name'                       => _x('Beer Styles', 'Taxonomy General Name', 'wp_boilerplate'),
                'singular_name'              => _x('Beer Style', 'Taxonomy Singular Name', 'wp_boilerplate'),
                'menu_name'                  => __('Beer Style', 'wp_boilerplate'),
                'all_items'                  => __('All Items', 'wp_boilerplate'),
                'parent_item'                => __('Parent Item', 'wp_boilerplate'),
                'parent_item_colon'          => __('Parent Item:', 'wp_boilerplate'),
                'new_item_name'              => __('New Item Name', 'wp_boilerplate'),
                'add_new_item'               => __('Add New Item', 'wp_boilerplate'),
                'edit_item'                  => __('Edit Item', 'wp_boilerplate'),
                'update_item'                => __('Update Item', 'wp_boilerplate'),
                'view_item'                  => __('View Item', 'wp_boilerplate'),
                'separate_items_with_commas' => __('Separate items with commas', 'wp_boilerplate'),
                'add_or_remove_items'        => __('Add or remove items', 'wp_boilerplate'),
                'choose_from_most_used'      => __('Choose from the most used', 'wp_boilerplate'),
                'popular_items'              => __('Popular Items', 'wp_boilerplate'),
                'search_items'               => __('Search Items', 'wp_boilerplate'),
                'not_found'                  => __('Not Found', 'wp_boilerplate'),
                'no_terms'                   => __('No items', 'wp_boilerplate'),
                'items_list'                 => __('Items list', 'wp_boilerplate'),
                'items_list_navigation'      => __('Items list navigation', 'wp_boilerplate'),
            ];
            $args = [
                'labels'                     => $labels,
                'hierarchical'               => true,
                'public'                     => true,
                'show_in_rest'               => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'show_tagcloud'              => true,
            ];
            register_taxonomy('beer_style', [ 'recipe' ], $args);
        }

        // Register Custom Taxonomy
        static function beer_sub_style() {
            $labels = [
                'name'                       => _x('Beer Sub Styles', 'Taxonomy General Name', 'wp_boilerplate'),
                'singular_name'              => _x('Beer Sub Style', 'Taxonomy Singular Name', 'wp_boilerplate'),
                'menu_name'                  => __('Beer Sub Style', 'wp_boilerplate'),
                'all_items'                  => __('All Items', 'wp_boilerplate'),
                'parent_item'                => __('Parent Item', 'wp_boilerplate'),
                'parent_item_colon'          => __('Parent Item:', 'wp_boilerplate'),
                'new_item_name'              => __('New Item Name', 'wp_boilerplate'),
                'add_new_item'               => __('Add New Item', 'wp_boilerplate'),
                'edit_item'                  => __('Edit Item', 'wp_boilerplate'),
                'update_item'                => __('Update Item', 'wp_boilerplate'),
                'view_item'                  => __('View Item', 'wp_boilerplate'),
                'separate_items_with_commas' => __('Separate items with commas', 'wp_boilerplate'),
                'add_or_remove_items'        => __('Add or remove items', 'wp_boilerplate'),
                'choose_from_most_used'      => __('Choose from the most used', 'wp_boilerplate'),
                'popular_items'              => __('Popular Items', 'wp_boilerplate'),
                'search_items'               => __('Search Items', 'wp_boilerplate'),
                'not_found'                  => __('Not Found', 'wp_boilerplate'),
                'no_terms'                   => __('No items', 'wp_boilerplate'),
                'items_list'                 => __('Items list', 'wp_boilerplate'),
                'items_list_navigation'      => __('Items list navigation', 'wp_boilerplate'),
            ];
            $args = [
                'labels'                     => $labels,
                'hierarchical'               => true,
                'public'                     => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'show_tagcloud'              => true,
            ];
            register_taxonomy('beer_sub_style', [ 'recipe' ], $args);
        }
    
    }