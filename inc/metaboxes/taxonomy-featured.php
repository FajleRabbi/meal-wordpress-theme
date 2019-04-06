<?php

function meal_recipe_metabox($metaboxes)
{
    $metaboxes[]    = array(
        'id'        => 'meal_recipe_taxonomy',
        'taxonomy'  => 'category',
        'post_type' => 'recipe',
        'fields'    => array(

            array(
                'id'    => 'featured',
                'type'  => 'switcher',
                'title' => __('Featured category', 'meal')
            ),

        ),
    );
    return $metaboxes;
}

add_filter('cs_taxonomy_options', 'meal_recipe_metabox');