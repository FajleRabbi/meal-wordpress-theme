<?php

function meal_recipe_type_metabox($metaboxes)
{
    $metaboxes[] = array(
        'id' => 'meal_recipe_metabox',
        'title' => __('Select Recipe Details', 'meal'),
        'post_type' => 'recipe',
        'context' => 'normal',
        'priority' => 'default',
        'sections' => array(
            // begin: a section
            array(
                'name' => 'meal_recipe_section_one',
               // 'title' => __('Section Type', 'meal'),
                'icon' => 'fa fa-image',
                'fields' => array(
                    array(
                        'id' => 'price',
                        'type' => 'text',
                        'title' => __('Recipe Price', 'meal'),
                        'default' => '0.0',
                    )
                ),
            ),
            // End: a Section
        ),
    );

    return $metaboxes;
}

add_filter('cs_metabox_options', 'meal_recipe_type_metabox');