<?php

function meal_service_section_metabox($metaboxes)
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
    if('service' != $section_type){
        return $metaboxes;
    }


    $metaboxes[] = array(
        'id' => 'meal_section_service',
        'title' => __('service Sections', 'meal'),
        'post_type' => 'section',
        'context' => 'normal',
        'priority' => 'default',
        'sections' => array(
            // begin: a section
            array(
                'name' => 'section_service',
                // 'title' => __('Select Sections', 'meal'),
                'icon' => 'fa fa-image',
                'fields' => array(
                    array(
                        'id' => 'services',
                        'type' => 'group',
                        'title' => __('Services', 'meal'),
                        'button_title' => __('New Service', 'meal'),
                        'according_title' => __('Add New Service', 'meal'),
                        'fields' => array(
                            array(
                                'id' => 'title',
                                'type' => 'text',
                                'title' => __('Title', 'meal')
                            ),
                            array(
                                'id' => 'icon',
                                'type' => 'select',
                                'title' => __('Icon', 'meal'),
                                'options' => array(
                                    'flaticon-chicken' => __('Chicken', 'meal'),
                                    'flaticon-pancake' => __('Pancake', 'meal'),
                                    'flaticon-salad' => __('Salad', 'meal'),
                                    'flaticon-soup' => __('Soup', 'meal'),
                                    'flaticon-vegetables' => __('Vegetables', 'meal'),
                                    'flaticon-tray' => __('Tray', 'meal'),
                                )
                            ),
                            array(
                                'id' => 'description',
                                'type' => 'textarea',
                                'title' => __('Description', 'meal')
                            ),
                        )
                    ),

                ),
            ),
            // End: a Section
        ),
    );

    return $metaboxes;
}

add_filter('cs_metabox_options', 'meal_service_section_metabox');