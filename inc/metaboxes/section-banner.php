<?php

function meal_banner_section_metabox($metaboxes)
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
    if('banner' != $section_type){
        return $metaboxes;
    }


    $metaboxes[] = array(
        'id' => 'meal_secton_banner',
        'title' => __('Banner Sections', 'meal'),
        'post_type' => 'section',
        'context' => 'normal',
        'priority' => 'default',
        'sections' => array(
            // begin: a section
            array(
                'name' => 'section_banner',
                // 'title' => __('Select Sections', 'meal'),
                'icon' => 'fa fa-image',
                'fields' => array(
                    array(
                        'id' => 'banner_image',
                        'type' => 'image',
                        'title' => __('Banner Image', 'meal')
                    ),
                    array(
                        'id' => 'button_title',
                        'type' => 'text',
                        'title' => __('Button Title', 'meal')
                    ),
                    array(
                        'id' => 'button_target',
                        'type' => 'text',
                        'title' => __('Button Target', 'meal')
                    )
                ),
            ),
            // End: a Section
        ),
    );

    return $metaboxes;
}

add_filter('cs_metabox_options', 'meal_banner_section_metabox');