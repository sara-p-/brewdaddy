<?php
    class WP_Boilerplate_CPT {
                static function recipe() {
            $labels = [
                'name'                  => _x('Recipes', 'Post Type General Name', 'wp_boilerplate'),
                'singular_name'         => _x('Recipe', 'Post Type Singular Name', 'wp_boilerplate'),
                'menu_name'             => __('Recipes', 'wp_boilerplate'),
                'name_admin_bar'        => __('Recipes', 'wp_boilerplate'),
                'archives'              => __('Item Archives', 'wp_boilerplate'),
                'attributes'            => __('Item Attributes', 'wp_boilerplate'),
                'parent_item_colon'     => __('Parent Recipe:', 'wp_boilerplate'),
                'all_items'             => __('All Recipes', 'wp_boilerplate'),
                'add_new_item'          => __('Add New Recipe', 'wp_boilerplate'),
                'add_new'               => __('Add Recipe', 'wp_boilerplate'),
                'new_item'              => __('New Recipe', 'wp_boilerplate'),
                'edit_item'             => __('Edit Recipe', 'wp_boilerplate'),
                'update_item'           => __('Update Recipe', 'wp_boilerplate'),
                'view_item'             => __('View Recipe', 'wp_boilerplate'),
                'view_items'            => __('View Recipes', 'wp_boilerplate'),
                'search_items'          => __('Search Recipes', 'wp_boilerplate'),
                'not_found'             => __('Not found', 'wp_boilerplate'),
                'not_found_in_trash'    => __('Not found in Trash', 'wp_boilerplate'),
                'featured_image'        => __('Featured Image', 'wp_boilerplate'),
                'set_featured_image'    => __('Set featured image', 'wp_boilerplate'),
                'remove_featured_image' => __('Remove featured image', 'wp_boilerplate'),
                'use_featured_image'    => __('Use as featured image', 'wp_boilerplate'),
                'insert_into_item'      => __('Insert into item', 'wp_boilerplate'),
                'uploaded_to_this_item' => __('Uploaded to this item', 'wp_boilerplate'),
                'items_list'            => __('Items list', 'wp_boilerplate'),
                'items_list_navigation' => __('Items list navigation', 'wp_boilerplate'),
                'filter_items_list'     => __('Filter items list', 'wp_boilerplate'),
            ];
            $args = [
                'label'                 => __('Recipe', 'wp_boilerplate'),
                'description'           => __('A collection of brewing recipes.', 'wp_boilerplate'),
                'labels'                => $labels,
                'supports'              => [ 'title', 'thumbnail' ],
                'taxonomies'            => [ 'recipe_categories' ],
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 20,
                'menu_icon'             => 'dashicons-welcome-widgets-menus',
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'has_archive'           => true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'capability_type'       => 'page',
            ];
            register_post_type('recipe', $args);
        }
    
    }