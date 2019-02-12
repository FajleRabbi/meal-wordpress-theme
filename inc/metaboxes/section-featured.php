<?php

function meal_featured_section_metabox($metaboxes)
{

    $section_id = 0;

    if ( isset( $_REQUEST['post'] ) || isset( $_REQUEST['post_ID'] ) ) {
        $section_id = empty( $_REQUEST['post_ID'] ) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
    }

    if('section'!=get_post_type($section_id)){
        return $metaboxes;
    }
    $section_meta = get_post_meta($section_id, 'meal_section_type', true);
    $section_type = $section_meta['type'];
    if('featured' != $section_type){
        return $metaboxes;
    }


    $metaboxes[] = array(
        'id' => 'meal_secton_featured',
        'title' => __('Featured Section', 'meal'),
        'post_type' => 'section',
        'context' => 'normal',
        'priority' => 'default',
        'sections' => array(
            // begin: a section
            array(
                'name' => 'page_sections',
                // 'title' => __('Select Sections', 'meal'),
                'icon' => 'fa fa-image',
                'fields' => array(
                    array(
                        'id' => 'recipes',
                        'type' => 'group',
                        'title' => __('Select Recipes', 'meal'),
                        'button_title' => __('New Recipe', 'meal'),
                        'according_title' => __('Add New Recipe', 'meal'),
                        'fields' => array(
                            array(
                                'id' => 'recipe',
                                'type' => 'select',
                                'options' => 'post',
                                'title' => __('Select Recipe', 'meal'),
                                'query_args' => array(
                                    'post_type' => 'recipe',
                                    'posts_per_page' => -1
                                )
                            ),
                        )
                    )
                ),
            ),
            // End: a Section
        ),
    );

    return $metaboxes;
}

add_filter('cs_metabox_options', 'meal_featured_section_metabox');