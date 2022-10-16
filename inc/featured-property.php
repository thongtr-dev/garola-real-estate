<?php

function property_featured_column($columns)
{
    $columns['featured_property'] = '<span class="dashicons dashicons-star-filled"></span>';
    return $columns;
}
add_filter('manage_property_posts_columns', 'property_featured_column');

function property_custom_column_values($column, $post_id)
{
    switch ($column) {

            // in this example, $buyer_id is post ID of another CPT called "buyer"
        case 'featured_property':
            $buyer_id = get_post_meta($post_id, $column, true);
            if ($buyer_id) {
                echo get_post_meta($buyer_id, 'buyer_name', true);
            } else {
                echo '<div class="dashicons dashicons-minus"></div>';
            }
            break;
    }
}
add_action('manage_property_posts_custom_column', 'property_custom_column_values', 10, 2);
