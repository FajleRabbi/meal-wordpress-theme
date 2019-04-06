<?php

function meal_gallery_section_metabox($metaboxes)
{

    $meal_section_id = 0;

    if ( isset( $_REQUEST['post'] ) || isset( $_REQUEST['post_ID'] ) ) {
        $meal_section_id = empty( $_REQUEST['post_ID'] ) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
    }

    if('section'!=get_post_type($meal_section_id)){
        return $metaboxes;
    }

    $section_meta = get_post_meta($meal_section_id, 'meal_section_type', true);
    $section_type = $section_meta['type'];
    if('gallery' != $section_type){
        return $metaboxes;
    }


    $metaboxes[] = array(
        'id' => 'meal_secton_gallery',
        'title' => __('Gallery Sections', 'meal'),
        'post_type' => 'section',
        'context' => 'normal',
        'priority' => 'default',
        'sections' => array(
            // begin: a section
            array(
                'name' => 'section_gallery',
                // 'title' => __('Select Sections', 'meal'),
                'icon' => 'fa fa-image',
                'fields' => array(
                    array(
                        'id' => 'protfolio',
                        'type' => 'group',
                        'title' => __('Protfolio', 'meal'),
                        'button_title' => __('New Image', 'meal'),
                        'according_title' => __('Add New Image', 'meal'),
                        'fields' => array(
                            array(
                                'id' => 'title',
                                'type' => 'text',
                                'title' => __('Title', 'meal')
                            ),
                            array(
                                'id' => 'image',
                                'type' => 'image',
                                'title' => __('Image', 'meal')
                            ),
                            array(
                                'id' => 'categories',
                                'type' => 'text',
                                'title' => __('Categories', 'meal')
                            )
                        )
                    ),

                ),
            ),
            // End: a Section
        ),
    );

    return $metaboxes;
}

add_filter('cs_metabox_options', 'meal_gallery_section_metabox');